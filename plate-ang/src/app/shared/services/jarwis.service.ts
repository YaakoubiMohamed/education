import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};
@Injectable()
export class JarwisService {
  private baseUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient) { }

  signup(data) {
    return this.http.post(`${this.baseUrl}/signup`, data, httpOptions)
  }

  login(data) {
    return this.http.post('http://localhost:8000/api/login', data, httpOptions)
  }

  sendPasswordResetLink(data) {
    return this.http.post(`${this.baseUrl}/sendPasswordResetLink`, data)
  }
  
  changePassword(data) {
    return this.http.post(`${this.baseUrl}/resetPassword`, data)
  }

  meInfo(token:string) {
    let headers = new HttpHeaders(
      {
        'Authorization': `Bearer ${token}`
      }
    );

    let options = { headers: headers };
    const url = `${this.baseUrl}/userauth`

    return this.http.post(url, null, options);
  }

}
