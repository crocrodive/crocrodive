import { StyleSheet, ScrollView } from 'react-native';
import { ThemedText } from '@/components/ThemedText';
import { FontSize } from '@/constants/FontSize';
import CardSessionStudent from '@/components/CardSessionStudent';
import CardSessionTeacher from '@/components/CardSessionTeacher';
import { useEffect, useState } from 'react';
import { useUser } from '@/contexts/UserContext';
import { fetchCourses } from '@/API/coursApiResource';
import { Course } from '@/types/Course';

export default function TabTwoScreen() {
  const { user } = useUser();
  const currentDate = new Date().toISOString().split('T')[0];
  const [courses, setCourses] = useState<Course[]>();

  const isStudent = user?.role_id !== "Instructor";

  useEffect(() => {
    async function getCourses() {
      setCourses(await fetchCourses()); 
    }
    getCourses();
  }, [])


  return (
    <ScrollView>
        <ThemedText type="title" style={styles.title}>Séances passée</ThemedText>
          {isStudent ? (
            courses?.map(course => (
              course.sessions.map(session => {
                if(new Date(session.date) < new Date(currentDate)){
                    const aptitudes = session.attendees[0].evaluations
                    .map(evaluation => ({
                      nom: evaluation.ability.label,
                      etat: evaluation.rating.id
                    }));
                  return <CardSessionStudent key={session.id} initiateur={session.instructor.firstname + ' ' + session.instructor.lastname} date={new Date(session.date).toLocaleDateString('fr-FR')} aptitudes={aptitudes} onPress={() => { } } lieu={course.site.name}/>
                }
              })
            ))
          ) : 
          (
            courses?.map(course => (
              course.sessions.map(session => {
                if(new Date(session.date) < new Date(currentDate)){
                    const eleves = session.attendees
                    .map(attendee => ({
                      nom: attendee.firstname + " " + attendee.lastname,
                      aptitudes: attendee.evaluations
                      .map(evaluation => ({
                        nom: evaluation.ability.label,
                        etat: evaluation.rating.id,
                        commentaire: evaluation.comment,
                        evaluation: evaluation.id,
                      }))
                    }));
                    
                  return <CardSessionTeacher key={session.id} initiateur={session.instructor.firstname + ' ' + session.instructor.lastname} date={new Date(session.date).toLocaleDateString('fr-FR')} eleves={eleves} evaluationState={session.state} onPress={() => { } } lieu={course.site.name} evaluation={session.attendees[0].evaluations[0].rating.id}/>
                }
              })
            ))
            
          )}
          
    </ScrollView>
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
      marginTop: 10,
    },
});
