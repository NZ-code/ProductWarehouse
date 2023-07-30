import axios from 'axios';
import { API_URL } from '../utils/constants';

export function deleteProductsByIds(productsIds){
    return axios.patch(API_URL,
        {
            'data':  {productsIds}
        }
    )
}
export function getProducts(){
    return axios.get(API_URL);
}
export function postProductWithFormData(formData){
    return axios.post(API_URL, formData);
}
