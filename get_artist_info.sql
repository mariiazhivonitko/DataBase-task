SELECT artists.Name, Title, tracks.Name
FROM artists, albums, tracks
WHERE artists.ArtistId = albums.ArtistId AND
	albums.AlbumId = tracks.AlbumId AND
	artists.ArtistID=1;

SELECT Name FROM artists WHERE ArtistID=2;