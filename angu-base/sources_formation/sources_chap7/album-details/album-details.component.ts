import { Component, OnInit, Input } from '@angular/core';
import { Album, List } from '../album';

import { ALBUM_LISTS } from '../mock-albums';

@Component({
  selector: 'app-album-details',
  templateUrl: './album-details.component.html',
  styleUrls: ['./album-details.component.scss']
})
export class AlbumDetailsComponent implements OnInit {

  @Input() album: Album; // propriété [album] liée 

  albumLists: List[] = ALBUM_LISTS; // récupération de la liste des chasons
  songs: List;

  constructor() { }

  ngOnInit() { }

  // dès que quelque chose "rentre" dans le component enfant via une propriété Input
  // ou à l'initialisation du component (une fois) cette méthode est appelée
  ngOnChanges() {
    // on vérifie que l'on a bien cliqué sur un album avant de rechercher dans la liste
    // des chansons.
    if(this.album){
      // récupération de la liste des chansons
      this.songs = this.albumLists.find(elem => elem.id === this.album.id);
    }
   
  }

}
