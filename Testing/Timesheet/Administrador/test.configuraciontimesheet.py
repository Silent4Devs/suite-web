from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
import time
import getpass
from selenium.webdriver.support.ui import Select


tiempo_modulos = 4
tiempo_carga = 10
tiempo_espera = 2.5
menu_xpath = "//i[contains(@class,'fa-solid fa-bars')]"
planes_de_accion_xpath = "//a[contains(.,'Planes de acción')]"
timesheet_xpath = "//i[@class='material-symbols-outlined' and text()='date_range']"
administrador_xpath = "//a[contains(.,'Administrador')]"
configurar_timesheet_xpath = "//a[contains(.,'Configuración Timesheet')]"
guardar_xpath = "//button[@class='btn btn-success' and contains(text(),'Guardar')]"
clientes_xpath="//a[contains(.,'Clientes')]"
registrar_timesheet_xpath="//a[contains(.,'Registrar TimeSheet')]"

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
    time.sleep(5)

    # Ingresar credenciales
    usr = driver.find_element(By.XPATH, "//input[contains(@name,'email')]").send_keys(usuario)
    pw = driver.find_element(By.XPATH, "//input[contains(@name,'password')]").send_keys(contrasena)

    # Hacer clic en el botón de envío
    btn = driver.find_element(By.XPATH, "//button[@type='submit'][contains(.,'Enviar')]")
    btn.click()

    # Esperar hasta 10 segundos para encontrar un elemento que indique un inicio de sesión exitoso
    element = WebDriverWait(driver, 3).until(
        EC.presence_of_element_located((By.XPATH, "//img[contains(@alt,'Logo Tabantaj')]"))
    )
    print("Inicio de sesión exitoso")
except TimeoutException:
    print("Inicio de sesión fallido")


#Timesheet
print("Entrando en Timesheet")
timesheet = WebDriverWait(driver, 5).until(EC.presence_of_element_located((By.XPATH, timesheet_xpath)))
timesheet_url = timesheet.get_attribute("href")
timesheet.click()
#ADMINISTRADOR
def admin(driver, xpath):
    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH,xpath))).click()
admin(driver, administrador_xpath)

#Configuración Timesheet
print("Entrando en Configuración Timesheet")
configuracion_timesheet = WebDriverWait(driver, 2).until(EC.presence_of_element_located((By.XPATH, configurar_timesheet_xpath)))
configuracion_timesheet.click()

        #FECHA DE INICIO TIMESHEET

try:

    # Localizar el elemento de entrada de fecha por su nombre utilizando By.NAME
    input_fecha = driver.find_element(By.NAME, 'fecha_registro_timesheet')
    # Limpiar el valor actual del campo de fecha
    input_fecha.clear()
    # Ingresar la nueva fecha ('2019-07-07') en el campo
    input_fecha.send_keys('2019-07-07')

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

        #limite de semanas para registros atrasados

try:

    input_numero = driver.find_element(By.NAME,'semanas_min_timesheet')
    valor_actual = int(input_numero.get_attribute('value'))
    nuevo_valor = valor_actual + 50
    input_numero.clear()
    input_numero.send_keys(str(nuevo_valor))

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

        #Limite de semanas que el colaborador puede adelantar
try:
    input_numero = driver.find_element(By.NAME,'semanas_adicionales')
    input_numero.clear()
    valor_fuera_de_rango = 52
    input_numero.send_keys(str(valor_fuera_de_rango))


except Exception as e:
    print(f"Se ha producido una excepción: {e}")


        #día de inicio de la jornada laboral

try:
    select_dia = Select(driver.find_element(By.NAME, 'inicio_timesheet'))
    select_dia.select_by_value('Domingo')

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

        #día de fin de la jornada laboral

try:

    select_dia = Select(driver.find_element(By.NAME, 'dia_timesheet'))
    select_dia.select_by_value('Lunes')

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

#Guardar
print("Guardando cambios")
guardar = WebDriverWait(driver, 1).until(EC.presence_of_element_located((By.XPATH, guardar_xpath)))
guardar.click()

#función de Admin.
time.sleep(2)
admin(driver, administrador_xpath)

        #CLIENTES
print("Entrando a Clientes")
clientes = WebDriverWait(driver, 4).until(EC.presence_of_element_located((By.XPATH, clientes_xpath)))
clientes.click()

        #REGISTRAR TIMESHEET
print("Entrando a Registrar Timesheet")
reg_time = WebDriverWait(driver, 2).until(EC.presence_of_element_located((By.XPATH, registrar_timesheet_xpath)))
reg_time.click()

        #ID
try:

    identificador = input("Ingrese el ID: ")
    input_identificador = driver.find_element(By.NAME, 'identificador')
    input_identificador.clear()
    input_identificador.send_keys(identificador)

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

        #RAZÓN SOCIAL
try:

    razon_social = input("Ingresa la razón social: ")
    input_razon_social = driver.find_element(By.NAME, 'razon_social')
    input_razon_social.clear()
    input_razon_social.send_keys(razon_social)


except Exception as e:
    print(f"Se ha producido una excepción: {e}")


        #NOMBRE COMERCIAL
try:

    nombre_comercial = input("Ingresa el nombre comercial del cliente: ")
    input_nombre_comercial = driver.find_element(By.NAME, 'nombre')
    input_nombre_comercial.clear()
    input_nombre_comercial.send_keys(nombre_comercial)

except Exception as e:
    print(f"Se ha producido una excepción: {e}")

#Guardar
print("Guardando cambios")
guardar = WebDriverWait(driver, 1).until(EC.presence_of_element_located((By.XPATH, guardar_xpath)))
guardar.click()

