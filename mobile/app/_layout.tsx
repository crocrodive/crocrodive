import { DarkTheme, DefaultTheme, ThemeProvider } from '@react-navigation/native';
import { useFonts } from 'expo-font';
import * as SplashScreen from 'expo-splash-screen';
import { StatusBar } from 'expo-status-bar';
import React, { useEffect } from 'react';
import 'react-native-reanimated';
import { Slot } from "expo-router";

import { useColorScheme } from '@/hooks/useColorScheme';
import { UserProvider } from '@/contexts/UserContext'; // Assurez-vous que le chemin est correct

SplashScreen.preventAutoHideAsync();

export default function RootLayout() {
  const colorScheme = useColorScheme();
  const [font] = useFonts({
      'Poppins-Regular': require('@/assets/fonts/Poppins-Regular.ttf'),
    });

  useEffect(() => {
    if (font) {
      SplashScreen.hideAsync();
    }
  }, [font]);

  if (!font) {
    return null;
  }

  return (
    <UserProvider>
      <ThemeProvider value={colorScheme === 'dark' ? DarkTheme : DefaultTheme}>
        <StatusBar style="auto" />
        <Slot/>
      </ThemeProvider>
    </UserProvider>
  );
}