import { Component } from '@angular/core';
import { NgModel } from '@angular/forms';

@Component({
  selector: 'app-table',
  imports: [],
  templateUrl: './table.html',
  styleUrl: './table.scss',
})
export class Table {
  public data = [
    {
      id: 3,
      nome: "Correia Dentada",
      data_compra: "2025-11-01",
      data_previsao: "2025-11-08",
      data_chegada: null,
      fornecedor: {
        nome: "Distribuidora Mecânica Pro",
        cnpj: "34.567.890/0001-77",
        telefone: "(21) 97777-3333",
        email: "atendimento@mecanicapro.com"
      },
      veiculo: {
        modelo: "Chevrolet Onix 2020",
        placa: "XYZ-9876"
      }
    },
    {
      id: 2,
      nome: "Pastilha de Freio",
      data_compra: "2025-10-17",
      data_previsao: "2025-10-25",
      data_chegada: "2025-10-24",
      fornecedor: {
        nome: "Peças Rápidas Ltda",
        cnpj: "23.456.789/0001-88",
        telefone: "(11) 98888-2222",
        email: "vendas@pecasrapidas.com"
      },
      veiculo: {
        modelo: "Fiat Uno 2015",
        placa: "ABC-1234"
      }
    },
    {
      id: 1,
      nome: "Filtro de Ar",
      data_compra: "2025-10-15",
      data_previsao: "2025-10-20",
      data_chegada: "2025-10-19",
      fornecedor: {
        nome: "Auto Peças Silva",
        cnpj: "12.345.678/0001-99",
        telefone: "(11) 99999-1111",
        email: "contato@autossilva.com"
      },
      veiculo: {
        modelo: "Fiat Uno 2015",
        placa: "ABC-1234"
      }
    }
  ];
}
