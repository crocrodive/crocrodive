import { useEffect } from "react";
import { useRootNavigationState, useRouter } from "expo-router";
import { useUser } from '@/contexts/UserContext';

export default function Index() {
  const router = useRouter();
  const navigationState = useRootNavigationState();
  const { user } = useUser();

  useEffect(() => {
    if (!navigationState?.key) return;
    if (user) {
      router.replace('/home');
    } else {
      router.replace('/(auth)/logIn');
    }
  }, [navigationState?.key, user]);

  return null;
}
