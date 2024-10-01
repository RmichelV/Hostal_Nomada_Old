import React from 'react'

const CardCarrousel = ({ name, desc, image }) => {
  return (
    <div className="card bg-base-100 image-full w-96 shadow-xl">
        <figure>
        <img
            src={image ? image : 'https://via.placeholder.com/150'} // Si no hay imagen, muestra un placeholder
            alt={name}
            className="rounded-box"
          />
        </figure>
        <div className="card-body">
            <h2 className="card-title">{name}</h2>
            <p>{desc}</p>
            <div className="card-actions justify-end">
            {/* <button className="btn btn-primary">Buy Now</button> */}
            </div>
        </div>
    </div>
  )
}

export default CardCarrousel
