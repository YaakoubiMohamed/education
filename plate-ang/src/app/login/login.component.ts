import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { first, tap, catchError } from 'rxjs/operators';
import { HttpClient } from '@angular/common/http';
import { FormBuilder, FormControl,  FormGroup, Validators } from '@angular/forms';
import { JarwisService } from '../shared/services/jarwis.service';
import { TokenService } from '../shared/services/token.service';
import { AuthService } from '../shared/services/auth.service';
import { AuthenticationService } from '../shared/services/authentication.service';
import { of } from 'rxjs';
const SUCCESS_REDIRECT_URL = '/';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
 
  registerForm: FormGroup;
  redirectUrl: string;
  submitted = false;
  userEmails = new FormGroup({
    email: new FormControl('',[
      Validators.required,
      Validators.pattern("^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$")]),
    password: new FormControl('',[
      Validators.required,
      Validators.minLength(6)]),
    }); 

    error:any;
    constructor(private formBuilder: FormBuilder,
      private Jarwis: JarwisService,
    private Token: TokenService,
    private router: Router,
    private Auth: AuthService,
    private authservice: AuthenticationService,
    //private snackBar: MatSnackBar
    ) { }

    ngOnInit() {
      
    }
    get email(){
      return this.userEmails.get('email')
      }
      onSubmit() {
        this.submitted =true;
        console.log(this.userEmails.value);
        this.authservice.login(this.userEmails.value.email, this.userEmails.value.password)
        .pipe(
          tap(user => {
            console.log(user);
            console.log(JSON.parse(localStorage.getItem('currentUser')));
          this.router.navigate(['/']);
          }),
          catchError(error => {
            console.log('Caught in CatchError. Returning 0',error);
            return error;     //return from(['A','B','C'])
          })
        ).subscribe();
        /*.subscribe(
          data => this.handleResponse(data),
          error => this.handleError(error)
        );*/
      }
      /*
      private openSnackBar(message: string, action: string) {
        this.snackBar.open(message, action, {
          duration: 2000,
        });
      }
    */
      handleResponse(data) {
        this.Token.handle(data);
        console.log(data.user);
        localStorage.setItem('user', JSON.stringify(data));
        this.Auth.changeAuthStatus(true);
        if(data.user.role == 'admin')
          this.router.navigateByUrl('/dashboard');
        if(data.user.role == 'patient')
          this.router.navigateByUrl('/home');
      }
    
      handleError(error) {
        this.error = error.error.error;
        console.log(error);
      }

  onReset() {
      this.submitted = false;
      this.registerForm.reset();
  }

    
}
