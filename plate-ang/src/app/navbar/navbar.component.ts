import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Departement } from '../shared/classes/departement';
import { DepartementsService } from '../shared/services/departement.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {


  departements:Departement[];
departement:Departement;
  user: any;

  constructor(private departementService:DepartementsService, private router:Router) { }

  ngOnInit() {
    this.user = JSON.parse(localStorage.getItem('currentUser'));
    setTimeout(() => {
      this.getDepartements(this.user.token);
      console.log(this.getDepartements);
    }, 1000);
  }


  getDepartements(token): void {
    this.departementService.getDepartments(token)
        .subscribe(specialite => {
          this.departements = specialite["records"];
          console.log('departements liste',this.departements);
        });
  }


}
