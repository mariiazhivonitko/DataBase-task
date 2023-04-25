SELECT artists.Name, Title, tracks.Name
FROM artists, albums, tracks
WHERE artists.ArtistId = albums.ArtistId AND
	albums.AlbumId = tracks.AlbumId AND
	artists.ArtistID=1;

SELECT Name FROM artists WHERE ArtistID=2;

SELECT Name
    FROM tracks, albums
    WHERE albums.AlbumId = tracks.AlbumId AND Title=
		(SELECT Name FROM artists WHERE ArtistID=2)