import pytest
from selenium import webdriver
from testing.pages.contratos.index.contratos_page import Contratos


def test_contratos(browser):
    #LOGIN
    contratos_page = Contratos(browser)
    contratos_page.login("zaid.garcia@becarios.silent4business.com","Administrador2")
    #MENÚ HAMBURGUESA
    contratos_page.open_menu()
    #GESTION CONTRACTUAL
    contratos_page.go_to_gestion_contractual()
    #CONTRATOS
    contratos_page.go_to_contratos()
    #CONTRATOS DEL ÁREA
    contratos_page.contratos_del_area()
    #BARRA DE BUSQUEDA
    search=""
    contratos_page.search_bar(search)
    #VISUALIZAR
    contratos_page.visualizar()
    #EXPORTAR
    #contratos_page.exportar()

