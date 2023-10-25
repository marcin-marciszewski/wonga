import { IProduct } from "../Interfaces";
import { AxiosInstance, AxiosError } from "axios";

interface Props {
  product: IProduct;
  client: AxiosInstance;
  productsList: IProduct[];
  setProductsList(productsList: IProduct[]): void;
}
const Product = ({ product, client, productsList, setProductsList }: Props) => {
  const deleteProduct = async (deletedProduct: IProduct): Promise<void> => {
    try {
      await client.delete(`/products/${deletedProduct.id}`);
      setProductsList(
        productsList.filter((product) => {
          return product.id !== deletedProduct.id;
        })
      );
    } catch (error) {
      const err = error as AxiosError;
      console.error(err);
    }
  };
  return (
    <tr>
      <td>{product.name}</td>
      <td>{product.stock}</td>
      <td>{product.net_price}</td>
      <td>{product.gross_price}</td>
      <td>{product.vat_rate}%</td>
      <td className="close-column">
        <div
          id="myCheck"
          className="close"
          aria-label="Close"
          onClick={() => {
            deleteProduct(product);
          }}
        >
          <span aria-hidden="true">&times;</span>
        </div>
      </td>
    </tr>
  );
};

export default Product;
