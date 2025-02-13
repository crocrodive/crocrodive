import { Colors } from '@/constants/Colors';
import { FontSize } from '@/constants/FontSize';
import React, { useState } from 'react';
import { View, StyleSheet, Text, TouchableOpacity, Modal } from 'react-native';

interface SessionProps {
    initiateur: string;
    date: string;
    lieu: string;
    aptitudes: {
        nom: string;
        etat: Etat;
    }[];
    onPress: () => void;
}

enum Etat {
    NonEvaluee = 1,
    EnCoursAcquisition,
    Acquise,
    Absent
}


const etatText = {
    [Etat.NonEvaluee]: "non évaluée",
    [Etat.EnCoursAcquisition]: "en cours d'acquisition",
    [Etat.Acquise]: "acquise",
    [Etat.Absent]: "absent"
};

export default function CardSessionStudent({ initiateur, lieu, date, aptitudes, onPress }: SessionProps) {
    const [isPopupVisible, setPopupVisible] = useState(false);

    const handlePress = () => {
        setPopupVisible(true);
        onPress();
    };

    const closePopup = () => {
        setPopupVisible(false);
    };

    return (
        <>
            <View style={styles.wrapper}></View>
            <TouchableOpacity onPress={handlePress} style={styles.container}>
                <View style={styles.header}>
                    <Text style={styles.title}>
                        {lieu}
                    </Text>
                    <Text style={styles.date}>
                        {date}
                    </Text>
                </View>
                <Text style={styles.titleInitiateur}>{initiateur}</Text>
                <View style={styles.separator} />
                <View style={styles.aptitudesList}>
                    {aptitudes.map((aptitude) => (
                        <View key={aptitude.nom} style={styles.aptitudeContainer}>
                            <View style={[
                                styles.circle,
                                aptitude.etat === Etat.NonEvaluee && styles.circleEtat1,
                                aptitude.etat === Etat.EnCoursAcquisition && styles.circleEtat2,
                                aptitude.etat === Etat.Acquise && styles.circleEtat3,
                            ]} />
                            <Text style={styles.aptitude}>
                                {aptitude.nom}
                            </Text>
                        </View>
                    ))}
                </View>
            </TouchableOpacity>
            <Modal
                visible={isPopupVisible}
                transparent={true}
                animationType='fade'
                onRequestClose={closePopup}
            >
                <View style={styles.popupContainer}>
                    <View style={styles.popupContent}>
                        <Text style={styles.popupTitle}>Détails des évaluations</Text>
                        {aptitudes.map((aptitude) => (
                            <View key={aptitude.nom} style={styles.popupAptitudeContainer}>
                                <Text style={styles.popupAptitudeName}>{aptitude.nom}</Text>
                                <View style={styles.aptitudePopupContainer}>
                                    <View style={[
                                    styles.circle,
                                    aptitude.etat === Etat.NonEvaluee && styles.circleEtat1,
                                    aptitude.etat === Etat.EnCoursAcquisition && styles.circleEtat2,
                                    aptitude.etat === Etat.Acquise && styles.circleEtat3,
                                    ]} />
                                    <Text style={styles.popupAptitudeEtat}>{etatText[aptitude.etat]}</Text>
                                </View>
                            </View>
                        ))}
                        <TouchableOpacity onPress={closePopup} style={styles.closeButton}>
                            <Text style={styles.closeButtonText}>Fermer</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            </Modal>
        </>
    );
}

const styles = StyleSheet.create({
    wrapper: {
        position: 'relative',
    },
    container: {
        padding: 10,
        backgroundColor: Colors.bg150,
        borderRadius: 8,
        marginBottom: 15,
        marginHorizontal: 15
    },
    header: {
        flexDirection: 'row',
        justifyContent: 'space-between',
        alignItems: 'center',
        marginLeft: 10,
    },
    title: {
        ...FontSize.normalText,
        fontWeight: 'bold',
    },
    titleInitiateur: {
        ...FontSize.normalText,
        fontWeight: 'bold',
        marginLeft: 8,
    },
    date: {
        ...FontSize.smallText,
    },
    separator: {
        height: 1,
        backgroundColor: Colors.bg200,
        marginVertical: 10,
    },
    aptitudeContainer: {
        flexDirection: 'row',
        alignItems: 'baseline',
    },
    aptitudesList: {
        marginLeft: 30,
        marginBottom: 10,
    },
    aptitude: {
        ...FontSize.smallText,
        marginRight: 5,
    },
    circle: {
        width: 10,
        height: 10,
        borderRadius: 30,
        marginRight: 10,
    },
    circleEtat1: {
        borderWidth: 1,
        borderColor: Colors.dark,
    },
    circleEtat2: {
        backgroundColor: Colors.aw100,
    },
    circleEtat3: {
        backgroundColor: Colors.as100,
    },
    popupContainer: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: 'rgba(0, 0, 0, 0.5)',
    },
    popupContent: {
        width: '80%',
        backgroundColor: 'white',
        borderRadius: 10,
        padding: 20,
        alignItems: 'center',
    },
    popupTitle: {
        ...FontSize.mediumText,
        fontWeight: 'bold',
        marginBottom: 20,
    },
    popupAptitudeContainer: {
        flexDirection: 'column',
        width: '100%',
        marginBottom: 10,
    },
    aptitudePopupContainer: {
        flexDirection: 'row',
        alignItems: 'center',
    },
    popupAptitudeName: {
        ...FontSize.normalText,
        fontWeight: 'bold',
    },
    popupAptitudeEtat: {
        ...FontSize.smallText,
        color: Colors.dark,
    },
    closeButton: {
        marginTop: 15,
        padding: 10,
        backgroundColor: Colors.cta300,
        borderRadius: 5,
    },
    closeButtonText: {
        ...FontSize.normalText,
        fontWeight: 'bold',
        color: Colors.light,
    },
});