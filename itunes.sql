

CREATE TABLE IF NOT EXISTS `itunes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kind` varchar(64) DEFAULT NULL,
  `features` text,
  `supportedDevices` text,
  `isGameCenterEnabled` varchar(32) DEFAULT NULL,
  `screenshotUrls` text,
  `ipadScreenshotUrls` text,
  `artworkUrl60` text,
  `artworkUrl512` text,
  `artistViewUrl` text,
  `artistId` int(11) DEFAULT NULL,
  `artistName` varchar(64) DEFAULT NULL,
  `price` varchar(32) DEFAULT NULL,
  `version` varchar(32) DEFAULT NULL,
  `description` text,
  `currency` varchar(16) DEFAULT NULL,
  `genres` text,
  `genreIds` text,
  `releaseDate` varchar(64) DEFAULT NULL,
  `sellerName` varchar(64) DEFAULT NULL,
  `bundleId` varchar(64) DEFAULT NULL,
  `trackId` int(11) DEFAULT NULL,
  `trackName` varchar(96) DEFAULT NULL,
  `primaryGenreName` text,
  `primaryGenreId` int(11) DEFAULT NULL,
  `formattedPrice` varchar(32) DEFAULT NULL,
  `wrapperType` varchar(32) DEFAULT NULL,
  `trackCensoredName` varchar(64) DEFAULT NULL,
  `languageCodesISO2A` varchar(16) DEFAULT NULL,
  `fileSizeBytes` bigint(20) DEFAULT NULL,
  `contentAdvisoryRating` varchar(32) DEFAULT NULL,
  `artworkUrl100` text,
  `trackViewUrl` text,
  `trackContentRating` varchar(16) DEFAULT NULL,
  `collectionId` int(11) DEFAULT NULL,
  `collectionName` varchar(96) DEFAULT NULL,
  `collectionCensoredName` varchar(96) DEFAULT NULL,
  `collectionViewUrl` text,
  `feedUrl` varchar(255) DEFAULT NULL,
  `artworkUrl30` text,
  `collectionPrice` float DEFAULT NULL,
  `trackPrice` float DEFAULT NULL,
  `collectionExplicitness` varchar(64) DEFAULT NULL,
  `trackExplicitness` varchar(64) DEFAULT NULL,
  `trackCount` int(11) DEFAULT NULL,
  `radioStationUrl` text,
  `country` varchar(96) DEFAULT NULL,
  `artworkUrl600` varchar(64) DEFAULT NULL,
  `artistType` varchar(64) DEFAULT NULL,
  `artistLinkUrl` text,
  `collectionType` varchar(128) DEFAULT NULL,
  `copyright` varchar(128) DEFAULT NULL,
  `previewUrl` varchar(128) DEFAULT NULL,
  `discCount` varchar(128) DEFAULT NULL,
  `discNumber` varchar(128) DEFAULT NULL,
  `trackNumber` varchar(128) DEFAULT NULL,
  `trackTimeMillis` varchar(128) DEFAULT NULL,
  `amgArtistId` varchar(128) DEFAULT NULL,
  `artistIds` varchar(128) DEFAULT NULL,
  `releaseNotes` varchar(128) DEFAULT NULL,
  `sellerUrl` varchar(128) DEFAULT NULL,
  `averageUserRatingForCurrentVersion` varchar(128) DEFAULT NULL,
  `userRatingCountForCurrentVersion` varchar(128) DEFAULT NULL,
  `averageUserRating` varchar(128) DEFAULT NULL,
  `userRatingCount` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=233 ;