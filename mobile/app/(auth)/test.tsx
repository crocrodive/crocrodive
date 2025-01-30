import CardSessionStudent from "@/components/CardSessionStudent";
import CardSessionTeacher from "@/components/CardSessionTeacher";
import { View } from "react-native";


export default function Index() {

    return (
        <View style={{padding: 10}}>
            <CardSessionStudent initiateur="Michel" date="30/01/2025" aptitudes={[{ nom: "Plonger", etat: 1 }, { nom: "Couler", etat: 2 }, { nom: "Application des procédures mises en œuvre par le GP", etat: 3 }]} onPress={() => {}} />
            <CardSessionStudent initiateur="Michel" date="30/01/2025" aptitudes={[{ nom: "Plonger", etat: 1 }, { nom: "Couler", etat: 2 }, { nom: "Nager", etat: 3 }]} onPress={() => {}} />
            <CardSessionTeacher initiateur="Michel" date="30/01/2025" eleves={[{ nom: "Paul", aptitudes: [{ nom: "Plonger", etat: 1}, { nom: "Couler", etat: 2}, { nom: "Nager", etat: 3}] }, { nom: "Gabrielle", aptitudes: [{ nom: "Plonger", etat: 1}, { nom: "Couler", etat: 2}, { nom: "Nager", etat: 3}] }]} />   
        </View>
    );
}