import React, { useState, useEffect } from 'react';
import PropTypes from 'prop-types';
// import { useStore } from 'react-redux';
import ReactMapGL, { Marker, Popup, GeolocateControl } from 'react-map-gl';
import { PacmanLoader } from 'react-spinners';

// DATA EN DUR
// import * as parkDate from '../../data/skateboard-parks.json';
// CSS MAPBOX
import 'src/styles/mapbox-gl.css';
import './map.scss';

const Map = ({
  viewport,
  mapboxApiAccessToken,
  mapStyle,
  updateViewport,
  updateFetchPosts,
  postsListsDetails,
}) => {
  // const store = useStore();
  //   console.log(store);
  // //console.log(
  //   'POST POUR LA MAP',
  //   postsListsDetails.map(
  //     (park) => console.log(park),
  //     // <Marker key={park.id} latitude={park.lat} longitude={park.lng}>
  //   ),
  // );

  // console.log('POST POUR LA MAP QUI EST UNDEFINED?', postsListsDetails);
  // IMPORT DES DATA EN DUR
  const [selectedPark, setSelectedPark] = useState(null);

  //  Fonction pour calculer la taille du Navigateur
  const [windowWidth, setWindowWidth] = useState(0);
  const [windowHeight, setWindowHeight] = useState(0);
  const [navbarHeight, setNavbarHeight] = useState(0);
  const [contentContainerWidth, setContentContainerWidth] = useState(0);
  const [mapLoading, setMapLoading] = useState(true);

  //calculer la largeur de la carte en fonction de la taille de l'ecran
  // document.querySelector('.contentContainer').offsetWidth

  let resizeWindow = () => {
    setNavbarHeight(document.querySelector('.navbar').offsetHeight);
    setContentContainerWidth(
      document.querySelector('.contentContainer').offsetWidth,
    );
    setWindowWidth(window.innerWidth);
    setWindowHeight(window.innerHeight);
  };
  //SUPRIMER LA HAUTEUR DE LA NAV POUR VOIR 100% DE LA CARTE
  // const [navBarSize, setnavBarSize] = useState(0);
  // let navBarSize = () => {
  //   setnavBarSize(window.innerWidth);
  // };
  // // let navBar=

  useEffect(() => {
    resizeWindow();
    window.addEventListener('resize', resizeWindow);
    // console.log(document.querySelector('.ui .container'));
    // console.log(document.querySelector('.ui .container').offsetHeight);
    return () => window.removeEventListener('resize', resizeWindow);
  }, []);
  // FIN DE LA FONCTION

  useEffect(() => {
    const listener = (e) => {
      if (e.key === 'Escape') {
        setSelectedPark(null);
      }
    };
    window.addEventListener('keydown', listener);

    return () => {
      window.removeEventListener('keydown', listener);
    };
  }, []);
  const handleChange = (mapChange) => {
    // console.error(
    //   '[Map -> index.js l.83] => {<ReactMapGL> appel handlechange} -> handlechange(mapchange) ',
    // );
    // console.error(
    //   "[Map -> index.js l.87] => handlechange(mapchange) => {qui donne l'argument mapchange ??} ",
    // );
    updateFetchPosts();
    updateViewport(mapChange);
  };
  // const handleResize = (event)=>{
  //   console.log('--------')
  //   console.log(event)
  //   console.log(event.height)
  //   // setViewportsize(event);
  //   console.log('--------')
  // }
  const handleLoad = (onLoadEvent) => {
    setMapLoading(false);
  };

  return (
    <>
      <ReactMapGL
        visible={!mapLoading}
        onLoad={handleLoad}
        reuseMaps={true}
        // asyncRender={true} Make the Marker Move on Scroll
        {...viewport}
        width={windowWidth - contentContainerWidth}
        height={windowHeight - navbarHeight}
        transitionDuration={250}
        mapboxApiAccessToken={mapboxApiAccessToken}
        mapStyle={mapStyle}
        // Animation sur le changement :  Viewport Transition
        // https://urbica.github.io/react-map-gl/#/Components/Layer
        // https://github.com/uber/react-map-gl/blob/master/docs/advanced/viewport-transition.md#examples/viewport-animation
        // onViewportChange={viewport => {
        //   setViewport(viewport);
        //   console.log(viewport);
        // }}
        onViewportChange={handleChange}
      >
        {postsListsDetails.map((park) => (
          // ICI A VERIFIER PREFERER LAYER A MARKER
          <Marker key={park.id} latitude={park.lat} longitude={park.lng}>
            {!mapLoading && (
              <img src="/public/DumpsterLogos.svg" alt="Dumpsters" />
            )}
          </Marker>
        ))}
      </ReactMapGL>
      <div className="float_center">
        {mapLoading && <PacmanLoader color={'#123abc'} loading={mapLoading} />}
      </div>
    </>
  );
};
Map.propTypes = {
  viewport: PropTypes.shape({
    latitude: PropTypes.number.isRequired,
    longitude: PropTypes.number.isRequired,
    // J'arrive pas a verfier le type de Height et Width car il change
    // width: PropTypes.number.isRequired,
    // height: PropTypes.number.isRequired,
    zoom: PropTypes.number.isRequired,
  }).isRequired,

  mapboxApiAccessToken: PropTypes.string.isRequired,
  mapStyle: PropTypes.string.isRequired,
  updateViewport: PropTypes.func.isRequired,
};

export default Map;
