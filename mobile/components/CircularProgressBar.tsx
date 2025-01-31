import { Colors } from "@/constants/Colors";
import { FontSize } from "@/constants/FontSize";
import React from "react";
import { View, Text, StyleSheet } from "react-native";
import Svg, { Circle } from "react-native-svg";

interface CircularProgressBarProps {
    progress: number;
    text: String;
}

export default function CircularProgressBar({ progress, text }: CircularProgressBarProps) {
    const radius = 40; // Rayon du cercle
    const strokeWidth = 8; // Largeur du trait
    const circumference = 2 * Math.PI * radius; // Circonférence du cercle
    const strokeDashoffset = circumference - (progress / 100) * circumference; // Calcul de la progression

    return (
        <>
            <View style={styles.container}>
                <Svg width={100} height={100}>
                    {/* Cercle de fond */}
                    <Circle
                        cx="50"
                        cy="50"
                        r={radius}
                        stroke={Colors.aw100}
                        strokeWidth={strokeWidth}
                        fill="none"
                    />
                    {/* Cercle de progression */}
                    <Circle
                        cx="50"
                        cy="50"
                        r={radius}
                        stroke={Colors.as200} // Couleur du cercle de progression
                        strokeWidth={strokeWidth}
                        fill="none"
                        strokeDasharray={circumference}
                        strokeDashoffset={strokeDashoffset}
                        strokeLinecap="round"
                        transform={`rotate(-90 50 50)`} // Rotation pour commencer en haut
                    />
                </Svg>
                {/* Texte au centre */}
                <View style={styles.textContainer}>
                    <Text style={styles.progressText}>{text}</Text>
                </View>
            </View>
        </>
    );
}

const styles = StyleSheet.create({
    container: {
        alignItems: "center",
        justifyContent: "center",
    },
    textContainer: {
        position: "absolute",
        alignItems: "center",
    },
    progressText: {
        ...FontSize.normalText,
        fontWeight: "bold",
        color: Colors.bg300,
    },
});
