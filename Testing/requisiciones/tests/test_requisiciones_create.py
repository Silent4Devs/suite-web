import pytest
from selenium import webdriver
from pages.requisiciones_create_page import Requisiciones_create


def test_requisiciones_create(browser):
    #LOGIN
    requisiciones_create_page= Requisiciones_create(browser)
    requisiciones_create_page.login("zaid.garcia@becarios.silent4business.com","Administrador2")
    #MENÚ HAMBURGUESA
    requisiciones_create_page.open_menu()
    #GESTION CONTRACTUAL
    requisiciones_create_page.go_to_gestion_contractual()
    #REQUISICIONES
    requisiciones_create_page.requisiciones_module()
