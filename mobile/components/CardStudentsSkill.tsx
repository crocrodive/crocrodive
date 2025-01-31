import { Colors } from "@/constants/Colors";
import { FontSize } from "@/constants/FontSize";
import React from "react";
import { View, Text, StyleSheet } from "react-native";
import CircularProgressBar from "./CircularProgressBar";

interface SkillProps {
    eleve: string;
    formation: {
        nomForm: string;
        competences: {
            nom: string;
            aptitudes: {
                nom: string;
                etat: number;
            }[]
        }[]
    };
}

enum Etat {
    NonEvaluee = 1,
    EnCoursAcquisition,
    Acquise,
    Absent
}

export default function CardStudentsSkill({ eleve, formation }: SkillProps) {
    const totalCompetences = formation.competences.length;
    const validatedCompetences = formation.competences.filter(comp => 
        comp.aptitudes.every(apt => apt.etat === Etat.Acquise)
    ).length;
    const acquiredPercentage = Math.round((validatedCompetences / totalCompetences) * 100);

    const textPourcentageValidatedSkill = `${validatedCompetences} / ${totalCompetences}`;

    return (
        <View style={styles.container}>
            <Text style={styles.title}>
                {eleve}
            </Text>
            <View style={styles.aptitudesProgress}>
                <View style={{flexDirection: "column", alignItems: "center", justifyContent: "center"}}>
                    <CircularProgressBar progress={acquiredPercentage} text={textPourcentageValidatedSkill} />
                    <Text style={styles.progressTextPourcentage}>{formation.nomForm}</Text>
                </View>
            </View>
        </View>
    );
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        flexDirection: "row",
        alignItems: "center",
        justifyContent: "space-between",
        backgroundColor: Colors.bg150,
        borderRadius: 10,
        marginBottom: 30,
        marginHorizontal: 50,
    },
    title: {
        ...FontSize.mediumText,
        fontWeight: "bold",
        marginBottom: 10,
        marginLeft: 10,
        textAlign: 'center',
        width: 300,
    },
    horizontalSeparator: {
        height: 1,
        backgroundColor: Colors.bg200,
        marginVertical: 10,
    },
    aptitudesProgress: {
        backgroundColor: Colors.light,
        margin: 10,
        marginHorizontal: 20,
        padding: 10,
        borderRadius: 8,
        flexDirection: "row",
        alignItems: "center",
    },
    progressTextPourcentage: {
        ...FontSize.normalText,        
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
        marginTop: 5,
    },
});