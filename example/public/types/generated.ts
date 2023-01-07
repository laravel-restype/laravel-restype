declare namespace App.Models {
    export type User = {
        id: number;
        name: string;
        email: string;
        role: 'viewer' | 'moderator' | 'admin';
    };
}
