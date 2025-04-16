import axios, { AxiosResponse, AxiosError } from 'axios';
import type {
    User, Newsletter, Campaign, CampaignStats, LoginCredentials, RegistrationData, ValidationError
} from '../types';

const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000';

const apiClient = axios.create({
    baseURL: API_BASE_URL,
    withCredentials: true,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    }
});


const handleResponse = <T>(response: AxiosResponse<T>): T => response.data;

const handleError = (error: unknown): Promise<never> => {
    if (axios.isAxiosError(error)) {
        const axiosError = error as AxiosError<ValidationError | { message: string }>;
         console.error("API Error:", axiosError.response?.status, axiosError.response?.data);
        return Promise.reject(axiosError.response?.data || axiosError.message);
    }
    console.error("Unexpected Error:", error);
    return Promise.reject(error);
};


export const getCsrfCookie = async (): Promise<void> => {
    try {
        await apiClient.get<void>('/sanctum/csrf-cookie'); 
        console.log("CSRF Cookie Set");
    } catch (error) {
        console.error("Error fetching CSRF cookie:", error);
    }
};


export const login = async (credentials: LoginCredentials): Promise<void> => {
    await getCsrfCookie();
    return apiClient.post<void>('/api/authenticate', credentials).then(() => undefined).catch(handleError);
};

export const getAuthUser = async (): Promise<User> => {
    return apiClient.get<User>('/api/user').then(handleResponse).catch(handleError);
};

export const logout = async (): Promise<void> => {
    try {
        await getCsrfCookie();
        await apiClient.post<void>('/api/logout');
         console.log("Logged out from backend");
    } catch (error) {
         console.error("Backend logout failed:", error);
         handleError(error);
    }
};

export const registerAdmin = async (userData: RegistrationData): Promise<User> => { 
  await getCsrfCookie();
  return apiClient.post<User>('/api/registrationUser', userData).then(handleResponse).catch(handleError);
};


type CreateNewsletterData = Omit<Newsletter, 'id' | 'created_at' | 'updated_at'>;
type UpdateNewsletterData = Partial<CreateNewsletterData>;

export const getNewsletters = async (): Promise<Newsletter[]> => {
    return apiClient.get<Newsletter[]>('/api/newsletters').then(handleResponse).catch(handleError);
};

 export const createNewsletter = async (data: CreateNewsletterData): Promise<Newsletter> => {
    await getCsrfCookie();
    return apiClient.post<Newsletter>('/api/newsletters', data).then(handleResponse).catch(handleError);
};

export const updateNewsletter = async (id: number, data: UpdateNewsletterData): Promise<Newsletter> => {
    await getCsrfCookie();
    return apiClient.put<Newsletter>(`/api/newsletters/${id}`, data).then(handleResponse).catch(handleError);
};

export const deleteNewsletter = async (id: number): Promise<void> => {
    await getCsrfCookie();
    return apiClient.delete<void>(`/api/newsletters/${id}`).then(() => undefined).catch(handleError);
};

// --- Campagnes ---
 type CreateCampaignData = Pick<Campaign, 'newsletter_id'>; 

 export const createCampaign = async (data: CreateCampaignData): Promise<Campaign> => {
     await getCsrfCookie();
     return apiClient.post<Campaign>('/api/campaigns', data).then(handleResponse).catch(handleError);
 };

 export const sendCampaign = async (id: number): Promise<void> => { 
     await getCsrfCookie();
     return apiClient.post<void>(`/api/campaigns/send/${id}`).then(() => undefined).catch(handleError);
 };

 export const getCampaignStats = async (id: number): Promise<CampaignStats> => {
     return apiClient.get<CampaignStats>(`/api/campaigns/${id}/stats`).then(handleResponse).catch(handleError);
 };



export default apiClient; 