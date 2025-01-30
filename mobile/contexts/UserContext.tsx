import React, { createContext, useContext, useState, useEffect } from "react";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { connect, fetchCurrentUser } from "@/API/user";
import { setToken } from "@/API/api";

// Définition du type User pour mieux structurer les données de l'utilisateur.
type User = {
    id: string;
    email: string;
    name: string;
    token: string; // Peut être un token si vous utilisez un système d'authentification avec des tokens.
};

// Définition du type du contexte utilisateur.
export type UserContextType = {
    user: User | null; // L'utilisateur actuel, ou null s'il n'y a pas de connexion active.
    login: (email: string, password: string) => Promise<void>; // Fonction de login.
    logout: () => Promise<void>; // Fonction de logout.
};

// Création du contexte avec une valeur par défaut null (cela sera renseigné par le Provider).
export const UserContext = createContext<UserContextType | null>(null);

// Hook personnalisé pour consommer le UserContext facilement dans d'autres composants.
export const useUser = () => {
    const context = useContext(UserContext);
    if (!context) {
        throw new Error("useUser doit être utilisé à l'intérieur de UserProvider");
    }
    return context;
};

// Fournisseur du contexte utilisateur, qui encapsule l'application et permet d'accéder à l'état de l'utilisateur.
export const UserProvider = ({ children }: { children: React.ReactNode }) => {
    const [user, setUser] = useState<User | null>(null);

    // Utilisation de useEffect pour charger les données utilisateur persistantes au démarrage.
    useEffect(() => {
        const loadUser = async () => {
            const storedUser = await AsyncStorage.getItem("user");
            if (storedUser) {
                setUser(JSON.parse(storedUser)); // Si l'utilisateur est trouvé dans AsyncStorage, on le charge.
            }
        };
        loadUser();
    }, []);

    // Fonction de connexion (login) avec appel API et stockage des données utilisateur.
    const login = async (email: string, password: string) => {
        try {
            // Appel à l'API pour la connexion (ici, on utilise notre service `loginService`).
            const { data, error } = await connect(email, password);

            if (error) {
                throw error;
            }

            setToken(data.token);

            // Récupération des données utilisateur après une connexion réussie.
            const currentUser = await fetchCurrentUser();

            // Mise à jour de l'état local avec les données utilisateur retournées par l'API.
            setUser(currentUser);

            // Sauvegarde de ces données dans AsyncStorage pour les rendre persistantes.
            await AsyncStorage.setItem("user", JSON.stringify(currentUser));
        } catch (error) {
            console.error("Erreur lors de la connexion : ", error);
            throw error; // On lance l'erreur pour qu'elle soit gérée dans le composant appelant.
        }
    };

    // Fonction de déconnexion (logout) qui supprime les données utilisateur en mémoire et dans AsyncStorage.
    const logout = async () => {
        setUser(null); // Réinitialisation de l'état utilisateur.
        await AsyncStorage.removeItem("user"); // Suppression des données persistantes de l'utilisateur dans AsyncStorage.
    };

    // Rendu du contexte utilisateur avec les fonctions et l'état utilisateur disponibles pour les autres composants.
    return (
        <UserContext.Provider value={{ user, login, logout }}>
            {children}
        </UserContext.Provider>
    );
};