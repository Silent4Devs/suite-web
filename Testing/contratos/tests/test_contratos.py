import pytest
from selenium import webdriver
from pages.contratos_page import Contratos


def test_contratos(browser):
    contratos_page = Contratos(browser)
    contratos_page.login("admin@admin.com","#S3cur3P4$$w0Rd!")
    contratos_page.open_menu()
    contratos_page.go_to_gestion_contractual()
    contratos_page.go_to_contratos()
    contratos_page.contratos_del_area()
