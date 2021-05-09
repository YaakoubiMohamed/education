import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './home/home.component';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { EnseignantComponent } from './enseignant/enseignant.component';
import { ClasseComponent } from './classe/classe.component';
import { CoursComponent } from './cours/cours.component';
import { DepartementComponent } from './departement/departement.component';
import { EtudiantComponent } from './etudiant/etudiant.component';
import { MatiereComponent } from './matiere/matiere.component';
import { MessageComponent } from './message/message.component';
import { QuizzComponent } from './quizz/quizz.component';
import { SectionComponent } from './section/section.component';
import { PublicationComponent } from './publication/publication.component';

const routes: Routes = [
  {path: 'home', component: HomeComponent },
  {path: 'login', component: LoginComponent },
  {path: 'enseignant', component: EnseignantComponent },
  {path: 'cours', component: CoursComponent },
  {path: 'classe', component: ClasseComponent },
  {path: 'departement', component: DepartementComponent },
  {path: 'etudiant', component: EtudiantComponent },
  {path: 'matiere', component: MatiereComponent },
  {path: 'message', component: MessageComponent },
  {path: 'quizz', component: QuizzComponent },
  {path: 'section', component: SectionComponent },
  {path: 'publication', component: PublicationComponent },












];

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    RouterModule.forRoot(routes)
  ]
})
export class AppRoutingModule { }
