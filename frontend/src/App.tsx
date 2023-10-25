import { FC, useState, useEffect } from "react";
import "./App.css";
import { IProduct } from "./Interfaces";
import Product from "./Components/Product";
import AddProduct from "./Components/AddProduct";
import axios, { AxiosResponse, AxiosInstance, AxiosError } from "axios";

const App: FC = () => {
  const [productsList, setProductsList] = useState<IProduct[]>([]);
  const client: AxiosInstance = axios.create({
    baseURL: "http://localhost:8080",
  });

  useEffect(() => {
    fetchProducts();
  }, []);

  const fetchProducts = async (): Promise<void> => {
    try {
      const response: AxiosResponse<IProduct[]> = await client.get("/products");
      setProductsList(response.data);
    } catch (error) {
      const err = error as AxiosError;
      console.error(err);
    }
  };

  return (
    <div className="App">
      <section>
        <div className="container py-5 h-100">
          <div className="row d-flex justify-content-center align-items-center h-100">
            <div className="col col-xl-10">
              <div className="card" style={{ borderRadius: 15 }}>
                <div className="card-body p-5">
                  <h6 className="mb-3">Produkty</h6>
                  <AddProduct
                    client={client}
                    productsList={productsList}
                    setProductsList={setProductsList}
                  />
                  {productsList.length > 0 ? (
                    <table>
                      <tbody>
                        <tr>
                          <th>Nazwa</th>
                          <th>Ilość</th>
                          <th>Cena netto</th>
                          <th>Cena brutto</th>
                          <th>Stawka vat</th>
                          <th className="close-column">Usuń</th>
                        </tr>
                        {productsList.map((product: IProduct) => {
                          return (
                            <Product
                              key={product.id}
                              product={product}
                              client={client}
                              productsList={productsList}
                              setProductsList={setProductsList}
                            />
                          );
                        })}
                      </tbody>
                    </table>
                  ) : (
                    <div>Brak produktów</div>
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default App;
