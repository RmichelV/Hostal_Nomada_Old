import React from 'react';
import CardCarrousel from '../cards/CardCarrousel';

const CarrouselHome = ({ roomTypes }) => {
  return (
    <div className="carousel carousel-center bg-teal-900 rounded-box w-full max-w-screen-lg space-x-4 p-4 overflow-x-auto flex justify-center">
      {roomTypes.map((room) => (
        <CardCarrousel name={room.name} desc={room.description} image={room.image}/>

      ))}
    </div>
  );
};

export default CarrouselHome;
