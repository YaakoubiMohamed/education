import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable, of } from 'rxjs';
import { catchError, map } from 'rxjs/operators';
import {ApiService} from "./api.service";

import { environment } from '../../../environments/environment';
import { Etudiant } from '../classes/etudiant';
import { Router } from '@angular/router';

const BASE_URL="http://127.0.0.1:8000";

@Injectable({ providedIn: 'root' })
export class AuthenticationService extends ApiService {
    private currentUserSubject: BehaviorSubject<Etudiant>;
    public currentUser: Observable<Etudiant>;
  
    constructor(protected httpClient: HttpClient) {
      super(httpClient);
      this.currentUserSubject = new BehaviorSubject<Etudiant>(JSON.parse(localStorage.getItem('currentUser')));
      this.currentUser = this.currentUserSubject.asObservable();
    }
  
    public get currentUserValue(): Etudiant {
      return this.currentUserSubject.value;
    }
  
  
    logout() {
      // remove user from local storage to log user out
      localStorage.removeItem('currentUser');
      this.currentUserSubject.next(null);
    }
  
    login(username: string, password: string): Observable<Etudiant> {
      return this.httpClient.post<any>('http://127.0.0.1:8000/api/login_check', {email: username, password: password})
        .pipe(
          map(user => {
            // login successful if there's a jwt token in the response
            console.log(user);
            if (user && user.token) {
              // store user details and jwt token in local storage to keep user logged in between page refreshes
              localStorage.setItem('currentUser', JSON.stringify(user));
              this.currentUserSubject.next(user);
            }
            return user;
          }),
          catchError(error => {
            //this.router.navigate(['newpage']);
            console.log(error);
            return of(false);
          })
        );
    }
  }