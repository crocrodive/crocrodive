import { IconSymbol } from "@/components/ui/IconSymbol";
import { Tabs } from "expo-router";
import FontAwesome from '@expo/vector-icons/FontAwesome';
import FontAwesome5 from '@expo/vector-icons/FontAwesome5';
import { Colors } from "@/constants/Colors";
import { TouchableOpacity } from "react-native";
import MaterialIcons from '@expo/vector-icons/MaterialIcons';
import { useUser } from '@/contexts/UserContext';
import { useRouter } from "expo-router";
import { UserContext } from '@/contexts/UserContext';
import { useContext } from 'react';  

export default function TabsLayout() {
  const userContext = useContext(UserContext);
  const router = useRouter();
  const { user } = useUser();
  const { logout } = useUser()


  const logOut = async() => {
    router.navigate('/logIn')
    await logout;
    console.log("UserContext :", userContext);
    console.log("User :", user);
  }

  return (
    <Tabs screenOptions={{
      tabBarShowLabel: false,
      tabBarActiveTintColor: Colors.dark,
      tabBarStyle: {
        height:70,
        borderTopWidth: 0,
        backgroundColor: Colors.bg100,
        elevation: 10,
        shadowOffset: {width:0 , height: -3},
        shadowColor: Colors.dark,
        shadowOpacity: 0.2,
        shadowRadius: 20,
      },
      headerRight: () => (
        <TouchableOpacity onPress={logOut}>
          <MaterialIcons name="logout" size={32} color= {Colors.dark} style= {{marginTop: 25, marginRight: 25}} />
        </TouchableOpacity>
      ),
    }}>
      <Tabs.Screen
        name="home"
        options={{
          title: '',
          tabBarIcon: ({ color }) => <IconSymbol size={48} name="house.fill" color={color} style= {{marginTop: 30}}/>,
          headerShown: true,
          headerStyle: {
            backgroundColor: Colors.bg100,
            borderWidth: 0,
          }
        }}
      />
      <Tabs.Screen
        name="aVenir"
        options={{
          title: '',
          tabBarIcon: ({ color }) => <FontAwesome name="calendar" size={40} color={color} style= {{marginTop: 30}}/>,
          headerShown: true,
          headerStyle: {
            backgroundColor: Colors.bg100,
            borderWidth: 0,
          }
        }}
      />
      <Tabs.Screen
        name="mesInfos"
        options={{
          title: '',
          tabBarIcon: ({ color }) => <FontAwesome5 name="user-circle" size={40} color={color} style= {{marginTop: 30}}/>,
          headerShown: true,
          headerStyle: {
            backgroundColor: Colors.bg100,
            borderWidth: 0,
          }
        }}
      />
    </Tabs>
  );
}
