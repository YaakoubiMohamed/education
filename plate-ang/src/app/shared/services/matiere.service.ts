import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, map, tap } from 'rxjs/operators';
import { Observable, of } from 'rxjs';
import { Matiere } from '../classes/matiere';
const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};

@Injectable({
  providedIn: 'root'
})
export class MatieresService {

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
  public baseUrl = 'http://127.0.0.1:8000/api/records/matieres';

constructor(private http: HttpClient) { }

getMatieres (): Observable<Matiere[]> {
  return this.http.get<Matiere[]>(this.baseUrl).pipe(
    tap(_ => console.log('fetched matieres')),
    catchError(this.handleError<Matiere[]>('getMatieres', []))
  );
}

}


