// mid way through my product aniem database got an update to v4 which made searching for everything way easier v3.4


$(document).ready(function(){

  //https://venturo.org/
// week 10
//AniDistro is a company partnered with all major anime streaming platform which allows the control of quality in downloads.
    // trust and reliable | address emotional issues | list what im designing for | why do they want anidistro


  var customSeasons = ['winter', 'spring', 'summer', 'fall'];
  var winter = ['jan', 'feb', 'mar'];
  var spring = ['apr', 'may', 'jun'];
  var summer = ['jul', 'aug', 'sep'];
  var fall = ['oct', 'nov', 'dec'];
  var customMonths = ['jan', 'feb', 'mar', 'apr', 'may', 'jun','jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
  function funcGenres(getAnimeGenresData){

  var genreBtnMobile = $(".genres-mobile");
  console.log(getAnimeGenresData);
    for (var i = 0; i < $(getAnimeGenresData.data).length; i++){
      $(genreBtnMobile).append("<option value="+getAnimeGenresData.data[i].mal_id+" class='button'>"+getAnimeGenresData.data[i].name+"</option>");
    }

  }
  // load genres
  function getAnimeGenres(){
    var getAnimeGenresUrl = "https://api.jikan.moe/v4/genres/anime/";
    $.getJSON(getAnimeGenresUrl, function(getAnimeGenresData) {
      console.log(getAnimeGenresData);
          funcGenres(getAnimeGenresData);
var genreBtn = $(".genres");
var genreBtnMobile = $(".genres-mobile");
var genresArray = [];
var genresIdArray;
console.log(genresArray);
  for (var i = 0; i < $(getAnimeGenresData.data).length; i++){
    var genreBtnContent = "<button value="+getAnimeGenresData.data[i].mal_id+" class='button'>"+getAnimeGenresData.data[i].name+"</button>";
        // var genreBtnMobileContnet = "<option value="+getAnimeGenresData.data[i].mal_id+" class='button'>"+getAnimeGenresData.data[i].name+"</option>"
genresArray.push(getAnimeGenresData.data[i].name);

    $(genreBtn).append(genreBtnContent);
    // $(genreBtnMobile).append(genreBtnMobileContnet);
  }
    });

  }
  getAnimeGenres();
// var genres = ['Action', 'Adventure', 'Cars', 'Comedy', 'Dementia', 'Demons', 'Mystery', 'Drama', 'Ecchi', 'Fantasy', 'Game', 'Hentai', 'Historical', 'Horror', 'Kids', 'Magic', 'Martial Arts', 'Mecha', 'Music', 'Parody', 'Samurai', 'Romance', 'School', 'Sci Fi', 'Shoujo', 'Shoujo Ai', 'Shounen', 'Shounen Ai', 'Space', 'Sports', 'Super Power', 'Vampire', 'Yaoi', 'Yuri', 'Harem', 'Slice Of Life', 'Supernatural', 'Military', 'Police', 'Psychological', 'Thriller', 'Seinen', 'Josei'];


$('.genres-mobile option').each(function() {
  if($(this).is(':selected')){
      var genreVal2 = $(this).val();
        searchGenres(genreVal2);
  }
});

$('.genres-mobile').click(function(){
    var genreVal2 = $(this).val();
    searchGenres(genreVal2);

});
$(document).on('click', '.genres .button', function() {
  $(this).each(function (){
var genreVal = $(this).val();
// alert(genreVal);
searchGenres(genreVal);

});

});
function searchGenres(genreVal, page){
  var page = 1;
  // https://api.jikan.moe/v4/anime?genres=1&page=2
  var searchGenreUrl = "https://api.jikan.moe/v4/anime?genres="+genreVal+"&page="+page+"&limit=24";
  $.getJSON(searchGenreUrl, function(searchGenreData) {
console.log(searchGenreData);
var getAnimeGenresUrl = "https://api.jikan.moe/v4/genres/anime/";
$.getJSON(getAnimeGenresUrl, function(getAnimeGenresData) {
  console.log("getAnimeGenresData");
console.log(getAnimeGenresData);
  var contentAnime = $(".content-anime");
    // for (var i = 0; i < $(getAnimeGenresData.data).length; i++){
  $(contentAnime).html("<h2 class='center-align'>"+getAnimeGenresData.data[--genreVal].name+"</h2>");
// }

  for (var i = 0; i < $(searchGenreData.data).length; i++){
    // console.log(searchGenreData.data[i].mal_id);
  $(contentAnime).append('<div class="col s12 m4 l4 xl3 animeImgWrapper"><img class="animeImg" src='+searchGenreData.data[i].images.jpg.large_image_url+' value="'+searchGenreData.data[i].mal_id+'"alt="'+searchGenreData.data[i].title+'"></div>');

  }
  console.log(searchGenreData);
  });
  });
}


// $('.animeImgWrapper').click(function(){
//
//   // alert('here');
// })
$(document).on('click', '.animeImgWrapper .animeImg', function() {
$(this).each(function (){
$('.overlay-modal').addClass("modal-overlay");
  $(".modal, .modal-content").fadeIn();
  // get myanimelist id
var searchAnimeId = $(this).attr("value");
var searchProviderAUId = 'https://api.jikan.moe/v4/anime/'+searchAnimeId+'';
$.getJSON(searchProviderAUId, function(searchProviderAUIdData) {
  console.log("searchProviderAUIdData1");
    console.log(searchProviderAUIdData);
  // get english name


  if (searchProviderAUIdData.data.title_english != null){
    var searchAnimeName = searchProviderAUIdData.data.title_english;
  }else{
    var searchAnimeName = searchProviderAUIdData.data.title;
  }
var searchAnimeImg = searchProviderAUIdData.data.images.jpg.large_image_url;
var searchAnimeSynopsis = searchProviderAUIdData.data.synopsis;
var searchAnimeEpisodes = searchProviderAUIdData.data.episodes;
var searchAnimeScore = searchProviderAUIdData.data.score;
var searchAnimeScoredBy = searchProviderAUIdData.data.scored_by;

if(searchProviderAUIdData.data.season != null){
  var searchAnimeAiredSeasonCom = ', ';
  var searchAnimeAiredSeason = searchProviderAUIdData.data.season;
}else{
    var searchAnimeAiredSeason = "";
      var searchAnimeAiredSeasonCom = "";
}
var searchAnimeAiredYear = searchProviderAUIdData.data.aired.prop.from.year;
var searchAnimeType = searchProviderAUIdData.data.type;

if (searchProviderAUIdData.data.trailer.embed_url != null){
  var searchAnimeTrailer = searchProviderAUIdData.data.trailer.embed_url;
}else{
    // $('.modal-trailer').empty();
  // alert('hjer');

}
var searchAnimeProducers = [];
var searchAnimeLicensors = [];
var searchAnimeGenres = [];
var searchAnimeGenresId = [];
for (var p = 0; p < $(searchProviderAUIdData.data.genres).length; p++){
  searchAnimeGenres.push(searchProviderAUIdData.data.genres[p].name);
}
for (var s = 0; s < $(searchAnimeGenres).length; s++){
  searchAnimeGenresId.push(searchProviderAUIdData.data.genres[s].mal_id);
}
for (var i = 0; i < $(searchProviderAUIdData.data.producers).length; i++){

searchAnimeProducers.push(searchProviderAUIdData.data.producers[i].name);
}
for (var o = 0; o < $(searchProviderAUIdData.data.licensors).length; o++){

searchAnimeLicensors.push(searchProviderAUIdData.data.licensors[o].name);
}
// search where to stream database with english name
var searchProviderAU = 'http://streamdata.malupdaterosx.moe/search/au?q=%'+searchAnimeName+'%';
$.getJSON(searchProviderAU, function(searchProviderAUData) {
  console.log("searchProviderAUData2");
  console.log(searchProviderAUData);
    console.log( "success open model of related anime1" );
}).fail(function() {
    console.log( "no streaming results found1" );
  });

var searchProviderAUId2 = 'https://streamdata.malupdaterosx.moe/lookup/au/'+searchAnimeId+'';
$.getJSON(searchProviderAUId2, function(searchProviderAUId2Data) {
aniContent(searchAnimeName, searchProviderAUId2Data, searchAnimeImg, searchAnimeSynopsis, searchAnimeEpisodes, searchAnimeScore, searchAnimeScoredBy, searchAnimeAiredSeason, searchAnimeAiredYear, searchAnimeType, searchAnimeTrailer, searchAnimeProducers, searchAnimeLicensors, searchAnimeAiredSeasonCom, searchAnimeGenres, searchAnimeGenresId);

}).fail(function(searchProviderAUId2Data) {
aniContent(searchAnimeName, searchProviderAUId2Data, searchAnimeImg, searchAnimeSynopsis, searchAnimeEpisodes, searchAnimeScore, searchAnimeScoredBy, searchAnimeAiredSeason, searchAnimeAiredYear, searchAnimeType, searchAnimeTrailer, searchAnimeProducers, searchAnimeLicensors, searchAnimeAiredSeasonCom, searchAnimeGenres, searchAnimeGenresId);
  });
});
});
});




function aniContent(searchAnimeName, searchProviderAUId2Data, searchAnimeImg, searchAnimeSynopsis, searchAnimeEpisodes, searchAnimeScore, searchAnimeScoredBy, searchAnimeAiredSeason, searchAnimeAiredYear, searchAnimeType, searchAnimeTrailer, searchAnimeProducers, searchAnimeLicensors, searchAnimeAiredSeasonCom, searchAnimeGenres, searchAnimeGenresId){
    console.log("searchProviderAUId2Data3");
    console.log(searchAnimeName);
    var modalAnime = $(".modal .modal-content");
// alert('aniContent');
          $(modalAnime).append("<h2 class='col s12 center-align'>"+searchAnimeName+"</h2>");
                $(modalAnime).append("<button class='modal-close button close-x'>x</button>");

          $(modalAnime).append('<img class="col s12 xl6 modal-animeImg" src='+searchAnimeImg+' alt="'+searchAnimeName+'">');

            $(modalAnime).append('<div class="col s12 xl6 modal-synopsis"><h5>Synopsis</h5><p>'+searchAnimeSynopsis+'</p><div class="col s12 xl12 modal-trailer"><h5>Trailer</h5><iframe allow="fullscreen;" width=100% height="600px" src='+searchAnimeTrailer+'>'+searchAnimeTrailer+'</iframe></div></div>');

          var modalAnimeContent = '<div class="info"><div class="col s12 m6 xl2 modal-aired"><h5>Aired</h5><button class="button premiered">'+searchAnimeAiredSeason+searchAnimeAiredSeasonCom+searchAnimeAiredYear+'</button></div><div class="col s12 m6 xl2 modal-watch"><h5>Watch</h5></div><div class="col s12 m6 xl2 modal-Type"><h5>Type</h5><button class="button" value='+searchAnimeType+'>'+searchAnimeType+'</button></div><div class="col s12 m6 xl2 modal-episodes"><h5>Episodes</h5><button class="button" value='+searchAnimeEpisodes+'>'+searchAnimeEpisodes+'</button></div><div class="col s12 m6 xl2 modal-score"><h5>Score</h5><button class="button">'+searchAnimeScore+'</button></div><div class="col s12 m6 xl2 modal-scoredBy"><h5>Scored By</h5><button class="button">'+searchAnimeScoredBy+'</button></div><div class="col s12 m6 xl2 modal-genres"><h5>Genres</h5></div><div class="col s12 m6 xl4 modal-licensors"><h5>Licensors</h5></div><div class="col s12 m6 xl4 modal-producers"><h5>Producers</h5></div></div>';
          $(modalAnime).append(modalAnimeContent);
// if(){
//
// }
  var modalWatch = $('.modal-watch');
  $(modalWatch).append(modalWatchContent);
  var modalWatchContent = modalWatch;
    console.log("searchProviderAUId2Data99");
  // console.log(searchProviderAUId2Data.data[0].sitename);
    // console.log(searchProviderAUId2Data.data[0].url);
    console.log(searchProviderAUId2Data);
    console.log($(searchProviderAUId2Data.data).length);
    if ($(searchProviderAUId2Data.data).length > 0){
        for (var i = 0; i < $(searchProviderAUId2Data.data).length; i++){
        $(modalWatchContent).append("<a class='button' href="+searchProviderAUId2Data.data[i].url+">"+searchProviderAUId2Data.data[i].sitename+"</a>");
        }
    }else{
      // alert('hwre');
        $(modalWatchContent).append("<button class='button'>None</button>");
    }
var modalGenres = $('.modal-genres');
$(modalGenres).append(modalGenresContent);
var modalGenresContent = modalGenres;
for (var a = 0; a < $(searchAnimeGenres).length; a++){
  $(modalGenresContent).append("<button class='button' value="+searchAnimeGenresId[a]+">"+searchAnimeGenres[a]+"</button>");
}
  var modalLicensors = $('.modal-licensors');
  $(modalLicensors).append(modalLicensorsContent);
  var modalLicensorsContent = modalLicensors;
  for (var o = 0; o < $(searchAnimeLicensors).length; o++){
    $(modalLicensorsContent).append("<button class='button' value="+searchAnimeLicensors[o]+">"+searchAnimeLicensors[o]+"</button>");
}
var modalProducers = $('.modal-producers');
$(modalProducers).append(modalProducersContent);
var modalProducersContent = modalProducers;
for (var p = 0; p < $(searchAnimeProducers).length; p++){
  $(modalProducersContent).append("<button class='button' value="+searchAnimeProducers[p]+">"+searchAnimeProducers[p]+"</button>");
}

// console.log(modalLicensorsContent);

    console.log( "success open model of that anime2" );
    $(document).on('click', '.premiered', function() {
      var year = searchAnimeAiredYear;
      var season = searchAnimeAiredSeason;

    // alert(year);

    var searchSeason = 'https://api.jikan.moe/v3/season/'+year+'/'+season+''
    $.getJSON(searchSeason, function(searchSeasonData) {
      console.log("searchSeasonData");
      console.log(searchSeasonData);
          alert('season here');
    });

    });
}

var contentAnime = $('.content-anime');
// $(contentAnime).before('<button class="next">Next</button>');

$('.next').click(function(){
  var page = 20;
  page++;
searchGenres(page);
});

$(document).on('click', '.modal-genres .button', function(){
  var genreVal = $(this).attr("value");
  var page = 1;
  $('.modal').hide();
  $('.modal .container .row .modal-content').empty().hide();
  $('.content-anime').empty();
  $('.modal-overlay').removeClass('modal-overlay');
  searchGenres(genreVal, page);
});

$(document).on('click', '.header-logo', function() {
location.reload();
});


$('.modal-close').click(function(){
  $(".modal").fadeOut(0);
  $(".modal-content").html("");
  $('.modal-overlay').removeClass('modal-overlay');
});

$(document).on('click', '.close-x', function(){
  $(".modal").fadeOut(0);
  $(".modal-content").html("");
  $('.modal-overlay').removeClass('modal-overlay');
});




});
