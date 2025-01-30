import { StyleSheet, Image, Platform, View, StatusBar } from 'react-native';

import { Collapsible } from '@/components/Collapsible';
import { ExternalLink } from '@/components/ExternalLink';
import ParallaxScrollView from '@/components/ParallaxScrollView';
import { ThemedText } from '@/components/ThemedText';
import { ThemedView } from '@/components/ThemedView';
import { IconSymbol } from '@/components/ui/IconSymbol';
import { FontSize } from '@/constants/FontSize';
import CardSessionStudent from '@/components/CardSessionStudent'
import CardSessionTeacher from '@/components/CardSessionTeacher';

export default function TabTwoScreen() {

  const isStudent = false

  const studentSessions = [
    { initiateur: "Michel", date: "30/01/2025", aptitudes: [{ nom: "Plonger", etat: 1}, { nom: "Couler", etat: 2}, { nom: "Nager", etat: 3}] },
    { initiateur: "Alice", date: "15/02/2025", aptitudes: [{ nom: "Courir", etat: 1}, { nom: "Sauter", etat: 2}, { nom: "Lancer", etat: 3}] },
    { initiateur: "John", date: "20/03/2025", aptitudes: [{ nom: "Escalader", etat: 1}, { nom: "Ramper", etat: 2}, { nom: "Grimper", etat: 3}] }
];

  return (
    <View>
      <ThemedText type="title" style={styles.title}>Séances à venir</ThemedText>
      {isStudent ? (
        studentSessions.map((session) => (
          <CardSessionStudent initiateur={session.initiateur} date= {session.date} aptitudes={session.aptitudes} onPress={() => {}}/>
        ))
      ) : 
      (
        studentSessions.map((session) => (
          <CardSessionTeacher initiateur={session.initiateur} date={session.date} eleves={[{ nom: "Paul", aptitudes: [{ nom: "Plonger", etat: 1}, { nom: "Couler", etat: 2}, { nom: "Nager", etat: 3}] }, { nom: "Gabrielle", aptitudes: [{ nom: "Plonger", etat: 1}, { nom: "Couler", etat: 2}, { nom: "Nager", etat: 3}] }]} onPress={() => {}}/>   
        ))
      )}
      
    </View>
  );
}

const styles = StyleSheet.create({
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
  title: {
      ...FontSize.largeText,
      fontWeight: 'bold',
      marginBottom: 15,
      marginLeft: 20,
      marginTop: 30,
    },
});