import pytest
from selenium import webdriver
from pages.contratos_page import GestionContractual


def test_contratos(browser):
    gestion_contractual = GestionContractual(browser)
    gestion_contractual.login("admin@admin.com","#S3cur3P4$$w0Rd!")
    gestion_contractual.open_menu()
    gestion_contractual.go_to_gestion_contractual()
