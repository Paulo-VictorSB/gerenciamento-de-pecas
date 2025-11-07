import { Component, } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { Hero } from './hero/hero';
import { Table } from './table/table';

@Component({
  selector: 'app-root',
  imports: [
    RouterOutlet,
    Hero,
    Table,
  ],
  templateUrl: './app.html',
  styleUrl: './app.scss'
})
export class App {

}
