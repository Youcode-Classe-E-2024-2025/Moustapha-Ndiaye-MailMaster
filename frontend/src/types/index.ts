

export interface User {
    id: number;
    name: string;
    email: string;
  }
  
  export interface Newsletter {
    id: number;
    name: string;
    content: string; 
    created_at: string;
    updated_at: string; 
  }
  
  export interface Campaign {
      id: number;
      newsletter_id: number;
      status: 'draft' | 'sending' | 'sent' | 'failed'; 
      sent_at?: string | null; 
      created_at: string;
      updated_at: string;
      newsletter?: Newsletter;
  }
  
   export interface CampaignStats {
      total_subscribers: number;
      sent_count: number;
     
  }
  
  export interface LoginCredentials {
      email: string;
      password: string;
  }
  
  export interface RegistrationData {
      name: string;
      email: string;
      password: string;
      password_confirmation: string;
  }
  
  export interface ValidationError {
      message: string;
      errors: {
          [key: string]: string[];
      };
  }