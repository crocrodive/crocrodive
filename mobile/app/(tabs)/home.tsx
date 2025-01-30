import { StyleSheet, TextInput, View } from 'react-native';
import { ThemedText } from '@/components/ThemedText';
import { FontSize } from '@/constants/FontSize';
import CardSessionStudent from '@/components/CardSessionStudent';
import { useContext, useEffect } from 'react';
import { UserContext } from '@/contexts/UserContext'; // Adjust the import path as needed

export default function TabTwoScreen() {
  const userContext = useContext(UserContext);

  useEffect(() => {
    console.log(userContext);
  }, [userContext]);

  const studentSessions = [
    { id: '1', initiateur: "Michel", date: "30/01/2025", aptitudes: [{ nom: "Plonger", etat: 1}, { nom: "Couler", etat: 2}, { nom: "Nager", etat: 3}] },
    { id: '2', initiateur: "Alice", date: "15/02/2025", aptitudes: [{ nom: "Courir", etat: 1}, { nom: "Sauter", etat: 2}, { nom: "Lancer", etat: 3}] },
    { id: '3', initiateur: "John", date: "20/03/2025", aptitudes: [{ nom: "Escalader", etat: 1}, { nom: "Ramper", etat: 2}, { nom: "Grimper", etat: 3}] }
  ];

  return (
    <View>
      <ThemedText type="title" style={styles.title}>Séances Passée</ThemedText>
      {studentSessions.map((session) => (
        <CardSessionStudent key={session.id} initiateur={session.initiateur} date= {session.date} aptitudes={session.aptitudes} onPress={() => {}}/>
      ))}
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
