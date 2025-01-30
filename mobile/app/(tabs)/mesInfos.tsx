import { StyleSheet, Image, Platform, View, StatusBar, Text } from 'react-native';

import { Collapsible } from '@/components/Collapsible';
import { ExternalLink } from '@/components/ExternalLink';
import ParallaxScrollView from '@/components/ParallaxScrollView';
import { ThemedText } from '@/components/ThemedText';
import { ThemedView } from '@/components/ThemedView';
import { IconSymbol } from '@/components/ui/IconSymbol';
import { FontSize } from '@/constants/FontSize';
import CardSessionStudent from '@/components/CardSessionStudent'
import { UserContext, UserContextType, useUser } from '@/contexts/UserContext';
import { useContext } from 'react';

export default function TabTwoScreen() {

  const { user } = useUser();

  return (
    <View>
      <Text style={styles.title}>Vous avez émergé {user.user_firstname} {user.user_lastname}</Text>
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