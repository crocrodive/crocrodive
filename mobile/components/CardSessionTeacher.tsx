import { Colors } from '@/constants/Colors';
import { FontSize } from '@/constants/FontSize';
import React, { useState } from 'react';
import { View, StyleSheet, Text, TouchableOpacity, Modal, TextInput, ScrollView } from 'react-native';
import { Picker } from '@react-native-picker/picker';
import { patchEvaluation } from '@/API/apiEvaluation';

interface SessionProps {
    initiateur: string;
    date: string;
    lieu: string;
    eleves: { 
        nom: string; 
        aptitudes: {
            nom: string;
            etat: number;
            commentaire?: string;
            evaluation: string;
        }[];
    }[]
    evaluationState: number;
    onPress: () => void;
}

enum EvaluationEtat {
    UPCOMING = 0,
    TO_BE_EVALUATED,
    EVALUATED,
}

export default function CardSessionTeacher({ initiateur, lieu, date, eleves, evaluationState, onPress}: SessionProps) {
    const [isPopupVisible, setPopupVisible] = useState(false);
    const [comments, setComments] = useState<{ [key: string]: string }>({});
    const [aptitudeStates, setAptitudeStates] = useState<{ [key: string]: number }>({});

    
    React.useEffect(() => {
        eleves.forEach(eleve => {
            eleve.aptitudes.forEach(aptitude => {
                setComments(prevComments => ({
                    ...prevComments,
                    [`${eleve.nom}-${aptitude.nom}`]: '',
                }));
                setAptitudeStates(prevStates => ({
                    ...prevStates,
                    [`${eleve.nom}-${aptitude.nom}`]: 1,
                }));
            });
        });
    }, [eleves]);


    const handlePress = () => {
        setPopupVisible(true);
        onPress();
    };
    
    const closePopup = () => {
        setPopupVisible(false);
    };

    const handleCommentChange = (eleveName: string, aptitudeName: string, text: string) => {
        setComments(prevComments => ({
            ...prevComments,
            [`${eleveName}-${aptitudeName}`]: text,
        }));
    };

    const handleAptitudeStateChange = (eleveName: string, aptitudeName: string, state: number) => {
        setAptitudeStates(prevStates => ({
            ...prevStates,
            [`${eleveName}-${aptitudeName}`]: state,
        }));
    };

    const handleValidate = () => {
        if (window.confirm("Êtes-vous sûr de vouloir valider?")) {
            Object.keys(comments).forEach((key) => {
                console.log(key)
                const [eleveName, aptitudeName] = key.split('-');
                const evaluationID = eleves.find(eleve => eleve.nom === eleveName)?.aptitudes.find(aptitude => aptitude.nom === aptitudeName)?.evaluation;
                if (evaluationID) {
                    patchEvaluation(evaluationID, {
                        comment: comments[key],
                        ratingId: aptitudeStates[key],
                    });
                }
            });
            closePopup();
        }
    };

    return (
        <>
            <TouchableOpacity onPress={handlePress} >
            <View style={styles.container}>
                <View style={styles.header}>
                    <Text style={styles.title}>
                        {lieu}
                    </Text>
                    <Text style={styles.date}>
                        {date}
                    </Text>
                </View>
                <Text style={styles.titleInitiateur}>{initiateur}</Text>
                <View style={styles.horizontalSeparator} />
                <View style={styles.elevesList}>
                    {eleves.map((eleve, index) => (
                        <View key={index} style={styles.eleveContainer}>
                            {index == eleves.length - 1 && <View style={styles.verticalSeparator} />}
                            <View style={styles.aptitudesList}>
                                <Text style={styles.eleve}>
                                    {eleve.nom}
                                </Text>
                                <View style={styles.aptitudesList} >
                                {eleve.aptitudes.map((aptitude) => (
                                    <View key={aptitude.nom} style={styles.aptitudeContainer}>
                                        <View style={[
                                            styles.circle, 
                                            aptitude.etat === 1 && styles.circleEtat1,
                                            aptitude.etat === 2 && styles.circleEtat2,
                                            aptitude.etat === 3 && styles.circleEtat3,
                                        ]} />
                                        <Text style={styles.aptitude}>
                                            {aptitude.nom}
                                        </Text>
                                    </View>
                                ))}
                                </View>
                            </View>
                        </View>
                    ))}
                </View>
                {evaluationState == EvaluationEtat.TO_BE_EVALUATED ? (
                    <>
                    <View style={styles.horizontalSeparator} />
                    <Text style={styles.evaluationText}>En attente d'évaluation</Text>
                    </>
                ) : null}
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
                        <Text style={styles.popupTitle}>Séance du {date}</Text>
                        <ScrollView style={styles.scrollView}>
                            {eleves.map((eleve, index) => (
                                <>
                                {index == eleves.length - 1 && <View style={styles.horizontalSeparatorPopup} />}
                            
                                <View key={index} style={styles.popupAptitudeContainer}>
                                    {eleves.length != 1 && index == eleves.length - 1 && <View style={styles.verticalSeparator} />}
                                    <View>
                                        <Text style={styles.eleve}>
                                            {eleve.nom}
                                        </Text>
                                        <View style={styles.aptitudesList} >
                                        {eleve.aptitudes.map((aptitude) => (
                                            <View key={aptitude.nom}>
                                                {evaluationState == EvaluationEtat.EVALUATED && (
                                                    <View style={styles.aptitudeContainer}>
                                                        <View style={[
                                                            styles.circle,
                                                            aptitude.etat === 1 && styles.circleEtat1,
                                                            aptitude.etat === 2 && styles.circleEtat2,
                                                            aptitude.etat === 3 && styles.circleEtat3,
                                                        ]} />
                                                        <Text style={styles.aptitude}>
                                                            {aptitude.nom}
                                                        </Text>
                                                    </View>
                                                )}
                                                {evaluationState == EvaluationEtat.EVALUATED ? (
                                                    <Text style={styles.popupAptitudeCommentaire}>{aptitude.commentaire}</Text>
                                                ) : (
                                                    <>
                                                        <View style={styles.aptitudeContainer}>
                                                            <View style={[
                                                                styles.circle,
                                                                aptitude.etat === 1 && styles.circleEtat1,
                                                                aptitude.etat === 2 && styles.circleEtat2,
                                                                aptitude.etat === 3 && styles.circleEtat3,
                                                            ]} />
                                                            <Text style={styles.aptitude}>
                                                                {aptitude.nom}
                                                            </Text>
                                                        </View>
                                                        <Picker
                                                            selectedValue={aptitudeStates[`${eleve.nom}-${aptitude.nom}`] || 0}
                                                            onValueChange={(itemValue) => handleAptitudeStateChange(eleve.nom, aptitude.nom, itemValue)}
                                                            style={styles.picker}
                                                        >
                                                            <Picker.Item label="Non évalué" value={1} />
                                                            <Picker.Item label="En cours d'acquisition" value={2} />
                                                            <Picker.Item label="Acquis" value={3} />
                                                            <Picker.Item label="Absent" value={4} />
                                                        </Picker>
                                                        <TextInput
                                                            style={styles.popupAptitudeCommentaire}
                                                            placeholder="Commentaire"
                                                            value={comments[`${eleve.nom}-${aptitude.nom}`] || ''}
                                                            onChangeText={(text) => handleCommentChange(eleve.nom, aptitude.nom, text)}
                                                            multiline={true}
                                                            scrollEnabled={true}
                                                        />
                                                    </>
                                                )}
                                            </View>
                                        ))}
                                        </View>
                                    </View>
                                </View>
                                </>
                            ))}
                        </ScrollView>
                        <View style={styles.buttonContainer}>
                            <TouchableOpacity onPress={closePopup} style={styles.cancelButton}>
                                <Text style={styles.cancelButtonText}>Fermer</Text>
                            </TouchableOpacity>
                            {evaluationState == EvaluationEtat.TO_BE_EVALUATED && (
                                <TouchableOpacity onPress={handleValidate} style={styles.validateButton}>
                                    <Text style={styles.validateButtonText}>Valider</Text>
                                </TouchableOpacity>
                            )}
                        </View>
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
        marginHorizontal: 15,
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
    horizontalSeparator: {
        height: 1,
        backgroundColor: Colors.bg200,
        marginVertical: 10,
    },
    verticalSeparator: {
        width: 1,
        backgroundColor: Colors.bg200,
        marginRight: 10,
        alignSelf: 'stretch',
    },
    eleveContainer: {
        flexDirection: 'row',
        flex: 1,
    },
    aptitudesList: {
        marginLeft: 10,
        flex: 1,
        flexWrap: 'wrap',
    },
    aptitude: {
        ...FontSize.smallText,
    },
    elevesList: {
        flexDirection: 'row',
        marginLeft: 10,
        marginBottom: 10,
    },
    eleve: {
        ...FontSize.normalText,
        fontWeight: 'bold',
        marginBottom: 5,
    },
    aptitudeContainer: {
        flexDirection: 'row',
        alignItems: 'baseline',
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
        width: '90%',
        maxHeight: '80%',
        backgroundColor: 'white',
        borderRadius: 10,
        padding: 20,
        alignItems: 'center',
    },
    horizontalSeparatorPopup: {
        height: 1,
        width: '30%',
        backgroundColor: Colors.bg300,
        marginVertical: 10,
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
        paddingRight: 10,
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
    popupAptitudeCommentaire: {
        ...FontSize.smallText,
        marginTop: 10,
        width: '100%',
        height: 80,
        borderRadius: 8,
        backgroundColor: Colors.bg100,
        padding: 5,
        marginBottom: 10,
        textAlignVertical: 'top',
    },
    evaluateButton: {
        marginTop: 10,
        padding: 10,
        backgroundColor: Colors.cta300,
        borderRadius: 5,
        alignItems: 'center',
    },
    evaluateButtonText: {
        ...FontSize.normalText,
        fontWeight: 'bold',
        color: Colors.light,
    },
    scrollView: {
        width: '100%',
    },
    picker: {
        width: '100%',
        height: 50,
        marginVertical: 5,
        paddingLeft: 8,
        borderRadius: 8,
    },
    buttonContainer: {
        flexDirection: 'row',
        justifyContent: 'space-between',
        width: '100%',
        marginTop: 10,
    },
    validateButton: {
        flex: 1,
        marginLeft: 5,
        padding: 10,
        backgroundColor: Colors.cta300,
        borderRadius: 5,
        alignItems: 'center',
    },
    validateButtonText: {
        ...FontSize.normalText,
        fontWeight: 'bold',
        color: Colors.light,
    },
    cancelButton: {
        flex: 1,
        padding: 10,
        marginRight: 5,
        backgroundColor: Colors.bg200,
        borderRadius: 5,
        alignItems: 'center',
    },
    cancelButtonText: {
        ...FontSize.normalText,
        fontWeight: 'bold',
        color: Colors.dark,
    },
    evaluationText: {
        ...FontSize.normalText,
        color: Colors.dark,
        textAlign: 'center',
        marginTop: 10,
    },
});