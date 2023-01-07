declare namespace App.Http.Controllers.Api {
    export type UserController = {
        get: {
            responses: { 0: App.Models.User };
            params?: null | undefined;
            query?: null | undefined;
            body?: null | undefined;
        };
    };
}
declare namespace App.Models {
    export type User = { id: number; name: string; email: string; role: 'viewer' | 'moderator' | 'admin' };
}
export interface ApiRoutesProps {
    params?: any;
    query?: any;
    body?: any;
    responses: any;
}
export type ApiRoutesType<I extends ApiRoutesProps> = Omit<I, 'responses'> & {
    method: string;
    url: string;
    response: I['responses'][keyof I['responses']];
};
export const ApiRoutes = {
    user: { method: 'GET', url: '/user' } as ApiRoutesType<App.Http.Controllers.Api.UserController['get']>,
};
export default App;
