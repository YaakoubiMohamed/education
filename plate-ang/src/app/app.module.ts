import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppComponent } from './app.component';
import { NavbarComponent } from './navbar/navbar.component';
import { FooterComponent } from './footer/footer.component';
import { AppRoutingModule } from './app-routing.module';
import { HomeComponent } from './home/home.component';
import { RouterModule } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { EnseignantComponent } from './enseignant/enseignant.component';
import { DepartementComponent } from './departement/departement.component';
import { SectionComponent } from './section/section.component';
import { ClasseComponent } from './classe/classe.component';
import { MatiereComponent } from './matiere/matiere.component';
import { QuizzComponent } from './quizz/quizz.component';
import { EtudiantComponent } from './etudiant/etudiant.component';
import { CoursComponent } from './cours/cours.component';
import { MessageComponent } from './message/message.component';
import { PublicationComponent } from './publication/publication.component';
import { JwtInterceptor } from './shared/classes/jwt.interceptor';
import { HttpClient, HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { ProfilComponent } from './profil/profil.component';
import { ProfilEnseignantComponent } from './profil-enseignant/profil-enseignant.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AuthService } from './shared/services/auth.service';
import { JarwisService } from './shared/services/jarwis.service';
import { TokenService } from './shared/services/token.service';




@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    FooterComponent,
    HomeComponent,
    LoginComponent,
    EnseignantComponent,
    DepartementComponent,
    SectionComponent,
    ClasseComponent,
    MatiereComponent,
    QuizzComponent,
    EtudiantComponent,
    CoursComponent,
    MessageComponent,
    PublicationComponent,
    ProfilComponent,
    ProfilEnseignantComponent,
   
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    RouterModule, 
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule
   
  ],
  


  providers: [
    {provide: HTTP_INTERCEPTORS, useClass: JwtInterceptor, multi: true},
    HttpClient,
    JarwisService,TokenService,AuthService
],
  bootstrap: [AppComponent]

  
})
export class AppModule { }
