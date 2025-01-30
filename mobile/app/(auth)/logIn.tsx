import React, { useState } from 'react';
import { View, Text, TextInput, Button, StyleSheet, Alert, TouchableOpacity } from 'react-native';
import { Colors } from "@/constants/Colors";
import { BorderRadius } from "@/constants/BorderRadius";
import { FontSize } from '@/constants/FontSize';
import {useFonts} from 'expo-font';
import { useRouter } from 'expo-router';
import { useUser } from '@/contexts/UserContext'; // Assurez-vous que le chemin est correct

export default function LoginScreen() {
  const [id, setId] = useState('');
  const [password, setPassword] = useState('');
  const [textColorID, setTextColorID] = useState(Colors.bg300)
  const [textColorMDP, setTextColorMDP] = useState(Colors.bg300)
  const [emailFocused, setEmailFocused] = useState(false);
  const [passwordFocused, setPasswordFocused] = useState(false);
  const router = useRouter()
  const { login } = useUser(); // Utilisez la fonction login de UserContext


  const [font] = useFonts({
    'Poppins-Regular': require('@/assets/fonts/Poppins-Regular.ttf'),
  });

  const handleTextChangeID = ( text: string) => {
    setId(text)
    setTextColorID(text ? Colors.dark : Colors.bg300)
  }

  const handleTextChangeMDP = ( text: string) => {
    setPassword(text)
    setTextColorMDP(text ? Colors.dark : Colors.bg300)
  }

  const handleLogin = async () => {
    try {
      await login(id, password);
      router.replace('/home');
    } catch (error) {
      if (error instanceof Error) {
        Alert.alert('Login failed', error.message);
      } else {
        Alert.alert('Login failed', 'An unknown error occurred');
      }
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Connexion</Text>

      <TextInput
        style={[styles.input, {color : textColorID}, {borderColor: emailFocused ? Colors.dark : Colors.bg200}]}
        placeholder="Identifiant"
        value={id}
        autoCapitalize="none"
        onChangeText= {handleTextChangeID}
        onFocus={() => setEmailFocused(true)}
        onBlur={() => setEmailFocused(false)}
      />

      <TextInput
        style={[styles.input, {color : textColorMDP}, { borderColor: passwordFocused ? Colors.dark : Colors.bg200 }]}
        placeholder="Mot de passe"
        value={password}
        onChangeText={handleTextChangeMDP}
        onFocus={() => setPasswordFocused(true)}
        onBlur={() => setPasswordFocused(false)}
        secureTextEntry
      />

      <TouchableOpacity style={styles.button} onPress={handleLogin}>
        <Text style={styles.buttonText}>Se connecter</Text>
      </TouchableOpacity>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: "center",
    padding: 16,
    backgroundColor: '#fff',
  },
  title: {
    ...FontSize.largeText,
    fontWeight: 'bold',
    textAlign: 'center',
    marginBottom: 15,
  },
  input: {
    ...FontSize.mediumText,
    fontFamily: "Poppins-Regular",
    height: 60,
    borderColor: Colors.bg200,
    borderWidth: 2,
    marginTop: 25,
    marginBottom: 25,
    width: 275,
    paddingHorizontal: 25,
    borderRadius: BorderRadius.button,
    color: Colors.bg300,
  },
  button: {
    backgroundColor: Colors.cta300,
    paddingVertical: 8,
    width: 180,
    borderRadius: BorderRadius.button,
    marginTop: 25
  },
  buttonText: {
    ...FontSize.h4,
    color: Colors.light,
    textAlign: 'center',
  },
});