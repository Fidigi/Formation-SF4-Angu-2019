import { Component, OnInit } from '@angular/core';

import { Album } from '../album';
import { ALBUMS } from '../mock-albums';
import { AlbumService } from '../album.service';

@Component({
  selector: 'app-albums',
  templateUrl: './albums.component.html',
  styleUrls: ['./albums.component.scss']
})
export class AlbumsComponent implements OnInit {

  titlePage: string = "Page princiaple Albums Music";
  albums: Album[] = ALBUMS;
  selectedAlbum : Album;
  status: string = null; // pour gérer l'affichage des caractères [play] 

  constructor(private ablumService: AlbumService) {
    // contrôle de la méthode count
    console.log(this.ablumService.count)
  }

  ngOnInit() {
    this.albums = this.ablumService.paginate(0,5);
  }

  onSelect(album: Album) {
    //console.log(album);
    this.selectedAlbum = album;
  }

  playParent($event){
    this.status = $event.id; // identifiant unique
    console.log($event)
  }
}
