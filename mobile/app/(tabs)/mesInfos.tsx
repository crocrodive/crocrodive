import { StyleSheet, Text, ScrollView, View } from 'react-native';
import { FontSize } from '@/constants/FontSize';
import { useUser } from '@/contexts/UserContext';
import CardSkill from "@/components/CardSkill";
import CardStudentsSkill from '@/components/CardStudentsSkill';

export default function TabTwoScreen() {

  const { user } = useUser();

  const isStudent = user?.role_id !== "Instructor";

  const aptSessions = [
    { competence:"S'équiper et se déséquiper", aptitudes:[{nom: "Gréage et dégréage", etat: 3}, {nom: "Capelage et décapelage", etat: 3}, {nom: "Choix de son matériel personnel", etat: 3}] },
    { competence:"Se mettre à l'eau et en sortir", aptitudes:[{nom: "Gréage et dégréage", etat: 2}, {nom: "Capelage et décapelage", etat: 2}, {nom: "Choix de son matériel personnel", etat: 3}] },
    { competence:"Evoluer dans l'eau et s'immerger", aptitudes:[{nom: "Gréage et dégréage", etat: 1}, {nom: "Capelage et décapelage", etat: 3}, {nom: "Choix de son matériel personnel", etat: 3}]}
  ];

  return (
    <ScrollView>
      {isStudent ? (
        <View>
          <View style={styles.headerContainer}>
            <Text style={styles.title_sec}>Avancée Formation Niveau {user?.level_id}</Text>
            <Text style={styles.name}>{user?.user_firstname} {user?.user_lastname.toUpperCase()}</Text>
          </View>
          {aptSessions.map((session, index) => (
            <CardSkill key={index} competence={session.competence} aptitudes={session.aptitudes} onPress={() => { /* handle press event */ }} />
          ))}
        </View>
      ) : (
        <View>
          <View style={styles.headerContainer}>
            <Text style={styles.title}>Les élèves de ma formation</Text>
          </View>
          {aptSessions.map((session, index) => (
            <CardStudentsSkill 
              key={index}
              eleve="Paul MORISSE" 
              formation={{ 
                nomForm: "Niveau 1", 
                competences: [
                  { nom: "Gréage et dégréage", aptitudes: [{ nom: "Plonger", etat: 3 }, { nom: "Couler", etat: 3 }, { nom: "Nager", etat: 3 }] },
                  { nom: "Gréage et dégréage", aptitudes: [{ nom: "Plonger", etat: 3 }, { nom: "Couler", etat: 3 }, { nom: "Nager", etat: 2 }] }
                ]
              }} 
            />
          ))}
        </View>
      )}
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  headerContainer: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    marginBottom: 15,
    marginLeft: 20,
    marginTop: 10,
  },
  headerImage: {
    color: '#808080',
    bottom: -90,
    left: -35,
    position: 'absolute',
  },
  titleContainer: {
    flexDirection: 'row',
    gap: 8,
  },
  title_sec: {
      ...FontSize.normalText,
      fontWeight: 'bold',
      marginLeft: 20,
    },
  name: {
      ...FontSize.normalText,
      fontWeight: 'bold',
      marginRight: 20,
      textAlign: "right",
    },
  title: {
    ...FontSize.largeText,
    fontWeight: 'bold',
    marginBottom: 15,
    marginLeft: 20,
    marginTop: 10,
  },
});