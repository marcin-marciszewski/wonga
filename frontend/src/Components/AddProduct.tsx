import { ChangeEvent, useState } from "react";
import { AxiosResponse, AxiosInstance, AxiosError } from "axios";
import { IProduct } from "../Interfaces";

interface Props {
  client: AxiosInstance;
  productsList: IProduct[];
  setProductsList(productsList: IProduct[]): void;
}

const AddProduct = ({ client, productsList, setProductsList }: Props) => {
  const [product, setProduct] = useState({
    name: "",
    stock: 0,
    net_price: 0,
    gross_price: 0,
    vat_rate: 0,
  });
  const handleChange = (event: ChangeEvent<HTMLInputElement>): void => {
    const value = event.target.value;
    setProduct({
      ...product,
      [event.target.name]: value,
    });
  };

  const addProduct = async (event: {
    preventDefault: () => void;
  }): Promise<void> => {
    event.preventDefault();
    try {
      let response: AxiosResponse<IProduct> = await client.post("/products", {
        product,
      });

      setProductsList([...productsList, response.data]);
      setProduct({
        name: "",
        stock: 0,
        net_price: 0,
        gross_price: 0,
        vat_rate: 0,
      });
    } catch (error) {
      const err = error as AxiosError;
      console.error(err);
    }
  };
  return (
    <div>
      <form className="add-form">
        <div className="input-fields">
          <div className="form-input">
            <label htmlFor="name">Nazwa</label>
            <input
              type="text"
              name="name"
              id="name"
              min="0"
              value={product.name}
              onChange={handleChange}
            />
          </div>
          <div className="form-input">
            <label htmlFor="stock">Ilość</label>
            <input
              type="number"
              name="stock"
              min="0"
              value={product.stock}
              onChange={handleChange}
              id="stock"
            />
          </div>
          <div className="form-input">
            <label htmlFor="name"> Cena netto</label>
            <input
              type="number"
              name="net_price"
              min="0"
              value={product.net_price}
              onChange={handleChange}
              id="net_price"
            />
          </div>
          <div className="form-input">
            <label htmlFor="name">Cena brutto</label>
            <input
              type="number"
              name="gross_price"
              min="0"
              value={product.gross_price}
              onChange={handleChange}
              id="gross_price"
            />
          </div>
          <div className="form-input">
            <label htmlFor="name">Stawka VAT</label>
            <input
              type="number"
              name="vat_rate"
              min="0"
              value={product.vat_rate}
              onChange={handleChange}
              id="vat_rate"
            />
          </div>
        </div>
        <div>
          <button onClick={addProduct} className="btn btn-primary btn-lg ms-2">
            Dodaj Produkt
          </button>
        </div>
      </form>
    </div>
  );
};

export default AddProduct;
