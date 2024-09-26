const CreditCard = ({ cardNumber, name, balance }) => {
    return (
      <div className="credit-card">
        <h3>Visa Premium Account</h3>
        <p>{cardNumber}</p>
        <p>{name}</p>
        <p>Saldo: Bs. {balance}</p>
      </div>
    );
  };
  
  export default CreditCard;
  