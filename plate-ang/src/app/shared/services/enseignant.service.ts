import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, tap } from 'rxjs/operators';
import { Observable, of } from 'rxjs';
import { Enseignant } from '../classes/enseignant';
const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};

@Injectable({
  providedIn: 'root'
})
export class EnseignantService {

  private handleError<T> (operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead

      // TODO: better job of transforming error for user consumption
      console.log(`${operation} failed: ${error.message}`);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }
  public baseUrl = 'http://127.0.0.1:8000/api/records/enseignants';

constructor(private http: HttpClient) { }

getDepartments (): Observable<Enseignant[]> {
  return this.http.get<Enseignant[]>(this.baseUrl).pipe(
    tap(_ => console.log('fetched departments')),
    catchError(this.handleError<Enseignant[]>('getDepartments', []))
  );
}

}