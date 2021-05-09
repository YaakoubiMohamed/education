import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, map, tap } from 'rxjs/operators';
import { Observable, of } from 'rxjs';
import { Message } from '../classes/message';
const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};

@Injectable({
  providedIn: 'root'
})
export class MessagesService {

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
  public baseUrl = 'http://127.0.0.1:8000/api/records/messages';

constructor(private http: HttpClient) { }

getMessages (): Observable<Message[]> {
  return this.http.get<Message[]>(this.baseUrl).pipe(
    tap(_ => console.log('fetched messages')),
    catchError(this.handleError<Message[]>('getMessages', []))
  );
}

}


