import { Colors } from "@/constants/Colors";
import { FontSize } from "@/constants/FontSize";
import { Ionicons } from "@expo/vector-icons";
import React, { useState } from "react";
import { View, Text, StyleSheet, Modal, TouchableOpacity, ScrollView } from "react-native";
import { ProgressBar } from 'react-native-paper';

interface SkillProps {
    competence: string;
    aptitudes: {
        nom: string;
        etat: number;
    }[];
    onPress: () => void;
}

enum Etat {
    NonEvaluee = 1,
    EnCoursAcquisition,
    Acquise,
    Absent
}

export default function CardSkill({ competence, aptitudes, onPress }: SkillProps) {
    const acquiredPercentage = Math.round((aptitudes.filter(a => a.etat === Etat.Acquise).length / aptitudes.length) * 100);
    const isComplete = acquiredPercentage === 100;
    const iconColor = acquiredPercentage === 0 ? Colors.dark : (isComplete ? Colors.as100 : Colors.aw100);
    const iconName = acquiredPercentage === 0 ? "ellipse-outline" : (isComplete ? "checkmark-circle" : "alert-circle");

    const [isPopupVisible, setPopupVisible] = useState(false);
    const closePopup = () => {
        setPopupVisible(false);
    };

    const handlePress = () => {
        setPopupVisible(true);
        onPress();
    };

    return (
        <>
            <TouchableOpacity onPress={handlePress}>
                <View style={styles.container}>
                    <Text style={styles.title}>
                        {competence}
                    </Text>
                    <View style={styles.horizontalSeparator} />
                    <View style={styles.aptitudesProgress}>
                        <Ionicons name={iconName} size={56} color={iconColor} />
                        <View style={styles.aptitudeItem}>
                            <View style={{flexDirection: "row", alignItems: "baseline"}}>
                                <Text style={styles.progressTextPourcentage}>{acquiredPercentage}%</Text>
                                <Text style={styles.progressText}>Validée</Text>
                            </View>
                            <ProgressBar progress={acquiredPercentage/100} color={iconColor} style={styles.progressBar} />
                        </View>
                    </View>
                    
                </View>        
            </TouchableOpacity>
            
            <Modal
                visible={isPopupVisible}
                transparent={true}
                animationType='fade'
                onRequestClose={closePopup}
            >
                <View style={styles.popupContainer}>
                    <View style={styles.popupWrapper}>
                        <ScrollView contentContainerStyle={styles.popupContent}>
                            <Text style={styles.title}>
                                {competence}
                            </Text>
                            <View  style={styles.aptitudesPopupProgress}>
                            {aptitudes.map((aptitude) => (
                                <> 
                                    <Text style={styles.popupAptitudeTexte}>{aptitude.nom}</Text>
                                    <View style={{ flexDirection: "row", alignItems: "center", justifyContent: "space-between" }}>
                                        {[...Array(3)].map((_, index) => (
                                            <Ionicons key={index} name={iconName} size={56} color={iconColor} />
                                        ))}
                                    </View>
                                </>
                            ))}
                            </View>
                            <TouchableOpacity onPress={closePopup} style={styles.cancelButton}>
                                <Text style={styles.cancelButtonText}>Fermer</Text>
                            </TouchableOpacity>
                        </ScrollView>
                    </View>
                </View>
            </Modal>
        </>
    );
}

const styles = StyleSheet.create({
    container: {
        backgroundColor: Colors.bg150,
        padding: 10,
        borderRadius: 10,
        marginBottom: 20,
        marginHorizontal: 20,
    },
    title: {
        ...FontSize.mediumText,
        fontWeight: "bold",
        marginBottom: 10,
        marginLeft: 10,
    },
    horizontalSeparator: {
        height: 1,
        backgroundColor: Colors.bg200,
        marginVertical: 10,
    },
    aptitudesProgress: {
        backgroundColor: Colors.light,
        margin: 5,
        marginHorizontal: 20,
        padding: 10,
        borderRadius: 8,
        flexDirection: "row",
        alignItems: "center",
    },
    aptitudeItem: {
        flex: 1,
        marginLeft: 10,
    },
    progressTextPourcentage: {
        ...FontSize.largeText,
        fontWeight: "bold",
    },
    progressText: {
        ...FontSize.normalText,
        marginLeft: 10,
        color: Colors.bg300,
    },
    progressBar: {
        height: 10,
        backgroundColor: Colors.bg100,
        borderRadius: 8,
    },
    popupContainer: {
        flex: 1,
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: 'rgba(0, 0, 0, 0.5)',
    },
    popupWrapper: {
        width: '90%',
        maxHeight: '80%',
        backgroundColor: 'white',
        borderRadius: 10,
        padding: 20,
        alignItems: 'center',
        flex: 1,
    },
    popupContent: {
        flexGrow: 1,
        alignItems: 'center',
        justifyContent: 'flex-start',
        paddingBottom: 20,
    },
    aptitudesPopupProgress: {
        flexDirection: "column",
        marginVertical: 10,
    },
    popupAptitudeTexte: {
        ...FontSize.normalText,
        fontWeight: "bold",
        marginBottom: 10,
    },
    cancelButton: {
        paddingVertical: 10,
        paddingHorizontal: 20,
        backgroundColor: Colors.bg200,
        borderRadius: 5,
        alignItems: 'center',
        justifyContent: 'center',
        alignSelf: 'center',
        marginTop: 20,
    },
    cancelButtonText: {
        ...FontSize.normalText,
        fontWeight: 'bold',
        color: Colors.dark,
    },
});