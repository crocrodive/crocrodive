import { IconSymbol } from "@/components/ui/IconSymbol";
import { Tabs } from "expo-router";
import FontAwesome from '@expo/vector-icons/FontAwesome';
import FontAwesome5 from '@expo/vector-icons/FontAwesome5';
import { Colors } from "@/constants/Colors";

export default function TabsLayout() {
  return (
    <Tabs screenOptions={{
      tabBarShowLabel: false,
      tabBarActiveTintColor: Colors.dark,
      tabBarStyle: {
        height:70,
      }
    }}>
      <Tabs.Screen
        name="home"
        options={{
          title: 'Home',
          tabBarIcon: ({ color }) => <IconSymbol size={48} name="house.fill" color={color} style={{marginTop: 30}}/>,
          headerShown: false,
        }}
      />
      <Tabs.Screen
        name="aVenir"
        options={{
          title: 'aVenir',
          tabBarIcon: ({ color }) => <FontAwesome name="calendar" size={40} color={color} style={{marginTop: 30}}/>,
          headerShown: false,
        }}
      />
      <Tabs.Screen
        name="mesInfos"
        options={{
          title: 'mesInfos',
          tabBarIcon: ({ color }) => <FontAwesome5 name="user-circle" size={40} color={color} style={{marginTop: 30}}/>,
          headerShown: false,
        }}
      />
    </Tabs>
  );
}