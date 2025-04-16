import React, { createContext, useState, useContext, useEffect, ReactNode, useMemo } from 'react';
import { User, LoginCredentials } from '../types';
import { getAuthUser, login as apiLogin, logout as apiLogout, getCsrfCookie } from '../services/apiService';

// Interface pour la valeur du contexte
interface AuthContextType {
    user: User | null;
    setUser: React.Dispatch<React.SetStateAction<User | null>>; 
    loginUser: (credentials: LoginCredentials) => Promise<void>; 
    logoutUser: () => Promise<void>;
    loading: boolean; 
    isAuthenticated: boolean;
}


const AuthContext = createContext<AuthContextType | null>(null);

interface AuthProviderProps {
    children: ReactNode;
}

export const AuthProvider: React.FC<AuthProviderProps> = ({ children }) => {
    const [user, setUser] = useState<User | null>(null);
    const [loading, setLoading] = useState<boolean>(true);

    useEffect(() => {
        const checkAuth = async () => {
            setLoading(true);
            try {
                await getCsrfCookie(); 
                const currentUser = await getAuthUser();
                setUser(currentUser);
            } catch (error) {
                console.log("Check auth failed or user not logged in.");
                setUser(null);
            } finally {
                setLoading(false);
            }
        };
        checkAuth();
    }, []); 

    const loginUser = async (credentials: LoginCredentials) => {
        
        await apiLogin(credentials); 
        const currentUser = await getAuthUser();
        setUser(currentUser);
    };

    const logoutUser = async () => {
        try {
            await apiLogout();
        } catch (error) {
            console.error("Logout API call failed, logging out client-side anyway.", error);
        } finally {
             setUser(null);
             
        }
    };

    const isAuthenticated = !!user;

    
    const contextValue = useMemo(() => ({
        user,
        setUser, 
        loginUser,
        logoutUser,
        loading,
        isAuthenticated
    }), [user, loading]); 

    return (
        <AuthContext.Provider value={contextValue}>
             {/* Affiche les enfants seulement quand le chargement initial est terminé */}
            {!loading ? children : <div>Chargement de l'application...</div>}
        </AuthContext.Provider>
    );
};

// Hook personnalisé pour utiliser le contexte
export const useAuth = (): AuthContextType => {
    const context = useContext(AuthContext);
    if (!context) {
        throw new Error('useAuth must be used within an AuthProvider');
    }
    return context;
};