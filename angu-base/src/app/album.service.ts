import { Injectable } from '@angular/core';
import { Album } from './album';
import { AlbumList } from './album-list';
import { ALBUMS, ALBUM_LISTS } from './mock-albums';

@Injectable({
  providedIn: 'root'
})
export class AlbumService {
  _albums: Album[] = ALBUMS;
  _albumLists: AlbumList[] = ALBUM_LISTS;

  constructor() { }

  count() {
    return this._albums.length;
  }

  getAlbums(): Album[] {
    return this._albums.sort(
      (a, b) => { return b.duration - a.duration }
    );
  }

  getAlbum( id: string): Album { 
    return this._albums.find(elem => elem.id === id);
  }

  getAlbumList( id : string): AlbumList { 
    return this._albumLists.find(elem => elem.id === id);
  }

  search(word: string): Album[] {
    if (word.length > 2) {
      let response = [];
      this._albums.forEach(album => {
        if (album.title.includes(word)) response.push(album);
      });

      return response;
    }
  }
}
