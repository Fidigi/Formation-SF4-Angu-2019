import { Injectable } from '@angular/core';

import { Album, List } from './album';
import { ALBUM_LISTS, ALBUMS } from './mock-albums'; 

@Injectable({
  providedIn: 'root'
})
export class AlbumService {

  private _albums: Album[] = ALBUMS; // _ convention private et protected
  private _albumList: List[] = ALBUM_LISTS;

  constructor() { }

  getAlbums(): Album[] {

    return this._albums.sort(
      (a, b) => { return b.duration - a.duration }
    );
  }

  getAlbum(id: string): Album  {

    return this._albums.find(album => album.id === id);
  }

  // recherche d'une référence dans la liste
  getAlbumList(id: string): List {

    return this._albumList.find(list => list.id === id);
  }

  count():number{

    return this._albums.length;
  }

 paginate(start: number, end: number):Album[]{

  // utilisez la méthode slice pour la pagination
  return this._albums.sort(
    (a, b) => { return b.duration - a.duration }
  ).slice(start, end);
 }
  
}
