from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time
import getpass
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.support.ui import Select


tiempo_modulos = 3
tiempo_carga = 10
tiempo_espera = 2.5

#  - - - - - - -- - - - - - - - - - - - - - - - -  X P A T H S  - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - - -  - - - - - - -

menu_xpath = "//button[contains(@onclick,'menuHeader();')]"
gestion_xpath = "//a[@href='https://192.168.9.78/admin/iso27001/inicio-guia']"
analisis_brechas_xpath = "//a[@href='https://192.168.9.78/admin/analisis-brechas-2022-inicio' and contains(text(), 'Entrar')]"
continuar_xpath = "//a[@href='https://192.168.9.78/admin/iso27001/normas-guia' and normalize-space()='CONTINUAR']"
iso27001_xpath = "//div[@class='card-body']"
nombre_template_xpath = "//input[@id='nombre_template']"
descripcion0_xpath = "//textarea[@id='descripcion']"

estatus_xpath = "//input[@id='estatus_1']"
estatus2_xpath = "//input[@id='estatus_2']"
estatus3_xpath="//input[@id='estatus_3']"
estatus4_xpath="//input[@id='estatus_4']"

valor1_xpath = "//input[@id='valor_estatus_1']"
valor2_xpath = "//input[@id='valor_estatus_2']"
valor3_xpath = "//input[@id='valor_estatus_3']"
valor4_xpath = "//input[@id='valor_estatus_4']"

descripcion1_xpath = "//input[@id='descripcion_parametros_1']"
descripcion2_xpath="//input[@id='descripcion_parametros_2']"
descripcion3_xpath="//input[@id='descripcion_parametros_3']"
descripcion4_xpath="//input[@id='descripcion_parametros_4']"

descripcion_seccion_xpath="//textarea[@id='descripcion_s1']"

pregunta_xpath = "//textarea[@id='pregunta1']"
generar_template_xpath = "//button[@class='btn btn-primary btn-block' and text()='Generar Template']"

# - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


# Pide al usuario que ingrese sus credenciales
usuario = input("Ingresa tu nombre de usuario: ")
contrasena = getpass.getpass("Ingresa tu contraseña: ")

# Crear una instancia del controlador de Firefox
driver = webdriver.Firefox()

try:
    # Abrir la URL
    driver.get('https://192.168.9.78/')

    # Maximizar la ventana del navegador
    driver.maximize_window()
    time.sleep(4)

    # Ingresar credenciales
    usr = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys(usuario)
    pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(contrasena)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()
    print("URL actual:", driver.current_url)

    # Esperar hasta 10 segundos para encontrar un elemento que indique un inicio de sesión exitoso
    element = WebDriverWait(driver, 3).until(
        EC.presence_of_element_located((By.XPATH, "//img[contains(@alt,'Logo Tabantaj')]"))
    )
    print("Inicio de sesión exitoso")
except TimeoutException:
    print("Inicio de sesión fallido")

#menú hamburguesa
print("Dando clic en el menú")
menu = WebDriverWait(driver,3).until(EC.presence_of_element_located((By.XPATH, menu_xpath)))
menu_url = menu.get_attribute("href")
menu.click()
print("URL actual:", driver.current_url)

print("Dando clic en Gestión Normativa")
gestion=WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, gestion_xpath)))
gestion_url = gestion.get_attribute("href")
gestion.click()
print("URL actual:", driver.current_url)

print("Dando clic en Continuar")
continuar=WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, continuar_xpath)))
continuar_url = continuar.get_attribute("href")
continuar.click()
print("URL actual:", driver.current_url)

print("Dando clic en ISO 27001")
url = "https://192.168.9.78/admin/iso27001/guia"
driver.get(url)
print("URL actual:", driver.current_url)

print("Dando clic en Análisis de Brechas")
analisis_brechas=WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, analisis_brechas_xpath)))
analisis_brechas_url = analisis_brechas.get_attribute("href")
analisis_brechas.click()
print("URL actual:", driver.current_url)

#Templates
print("Dando clic en Templates")
url = "https://192.168.9.78/admin/templates/create"
driver.get(url)
print("URL actual:", driver.current_url)

#Nombre del template
print("Llenando nombre del template")
nombre_template=WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, nombre_template_xpath)))
nombre_template.send_keys("Template de prueba")
print("URL actual:", driver.current_url)

#Select
select_element = driver.find_element("css selector", "#norma")
select = Select(select_element)
select.select_by_value("2")


#Descripción
print("Llenando descripción")
descripcion_element = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, descripcion0_xpath)))
descripcion = input("Ingrese la descripción: ")
descripcion_element.send_keys(descripcion)

#Estatus 1
print("Seleccionando estatus")
estatus_element=WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, estatus_xpath)))
estatus=input("Ingrese el estatus: ")
estatus_element.send_keys(estatus)

#Valor 1
print("Llenando valor 1")
valor1_element = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, valor1_xpath)))
valor1 = input("Ingrese el valor 1: ")
valor1_element.send_keys(valor1)

#Descripción    1
print("Llenando la descripcion de parametros")
descripcion_element = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, descripcion1_xpath)))
descripcion = input("Ingrese la descripción: ")
descripcion_element.send_keys(descripcion)

#Estatus 2
print("Seleccionando estatus")
estatus_element=WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, estatus2_xpath)))
estatus=input("Ingrese el estatus: ")
estatus_element.send_keys(estatus)


#Valor 2
print("Llenando valor 2")
valor2_element = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, valor2_xpath)))
valor2 = input("Ingrese el valor 2: ")
valor2_element.send_keys(valor2)


#Descripción    2
print("Llenando la descripcion de parametros")
descripcion_element = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, descripcion2_xpath)))
descripcion = input("Ingrese la descripción: ")
descripcion_element.send_keys(descripcion)


#Estatus 3
print("Seleccionando estatus")
estatus_element=WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, estatus3_xpath)))
estatus=input("Ingrese el estatus: ")
estatus_element.send_keys(estatus)

#Valor 3
print("Llenando valor 3")
valor3_element = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, valor3_xpath)))
valor3 = input("Ingrese el valor 3: ")
valor3_element.send_keys(valor3)

#Descripción    3
print("Llenando la descripcion de parametros")
descripcion_element = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, descripcion3_xpath)))
descripcion = input("Ingrese la descripción: ")
descripcion_element.send_keys(descripcion)


#Estatus 4
print("Seleccionando estatus")
estatus_element=WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, estatus4_xpath)))
estatus=input("Ingrese el estatus: ")
estatus_element.send_keys(estatus)

#Valor 4
print("Llenando valor 4")
valor4_element = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, valor3_xpath)))
valor4 = input("Ingrese el valor 4: ")
valor4_element.send_keys(valor4)

#Descripción    4
print("Llenando la descripcion de parametros")
descripcion_element = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, descripcion4_xpath)))
descripcion = input("Ingrese la descripción: ")
descripcion_element.send_keys(descripcion)



#Sección descripción
print("Llenandola descripción de la sección 1")
descripcion_element = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, descripcion_seccion_xpath)))
descripcion = input("Ingrese la descripción: ")
descripcion_element.send_keys(descripcion)

#Formulario descripción
print("Llenando la pregunta")
pregunta_element = WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, pregunta_xpath)))
pregunta = input("Ingrese la pregunta: ")
pregunta_element.send_keys(pregunta)

#Generar Template
print("Generando template")
template=WebDriverWait(driver, 3).until(EC.presence_of_element_located((By.XPATH, generar_template_xpath)))
template.click()
print("URL actual:", driver.current_url)
print("Template generado exitosamente")
