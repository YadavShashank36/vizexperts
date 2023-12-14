# Sample Nextcloud App

This app showcases basic functionalities within a Nextcloud environment, allowing users to interact with files via RESTful API endpoints.

## Functionalities

1. **Browse File**:
   - Endpoint: `/api/v1/browse/{fileName}`
   - Method: `GET`
   - Description: Fetches the content of the specified file.

2. **Upload File**:
   - Endpoint: `/api/v1/upload/{fileName}`
   - Method: `PUT`
   - Description: Uploads a file by sending the raw file contents as the request body.

3. **Download File**:
   - Endpoint: `/api/v1/download/{fileName}`
   - Method: `GET`
   - Description: Initiates the download of the specified file.

## Installation

1. Clone this repository into your Nextcloud `apps` directory.
2. Enable the app in the Nextcloud admin panel.
3. Configure necessary permissions for file access and user authentication.

## Clone the repo

```bash
git clone https://github.com/YadavShashank36/vizexperts
```

## Usage

### Browse File

```http
GET /api/v1/browse/Sample.txt
```

### Upload File
```
PUT /api/v1/upload/Sample.txt
Raw Body: [file contents]
```

### Download File
```
GET /api/v1/download/Sample.txt
```

# Endpoints

## `/api/v1/browse/{fileName}`

Fetches the content of the specified file.

## `/api/v1/upload/{fileName}`

Uploads a file by sending the raw file contents as the request body.

## `/api/v1/download/{fileName}`

Initiates the download of the specified file.




