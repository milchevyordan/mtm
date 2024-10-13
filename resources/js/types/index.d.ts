export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};

export interface User {
    id: number;
    creator_id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    creator?: User;
}

export interface UserForm extends Omit<User, 'creator_id'>, Form {

}

interface Flash {
    errors?: string[];
    error?: string;
    warning?: string;
    success?: string;
}