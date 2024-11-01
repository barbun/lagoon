<?php

$idpBaseURL = getenv('SIMPLESAMLPHP_IDP_BASE_URL');
$idpEntityId = getenv('SIMPLESAMLPHP_IDP_ENTITYID') ?: $idpBaseURL;
$fallbackBinding = getenv('SIMPLESAMLPHP_IDP_DEFAULT_BINDING');

$metadata[$idpEntityId] = [
  'entityid' => $idpEntityId,
  'contacts' => [],
  'metadata-set' => 'saml20-idp-remote',
  'sign.authnrequest' => getenv('SIMPLESAMLPHP_IDP_SIGN_AUTH') ?: FALSE,
  'SingleSignOnService' => [
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
      'Location' => $idpBaseURL . (getenv('SIMPLESAMLPHP_IDP_SIGNON_HTTP_POST_BINDING') ?: $fallbackBinding),
    ],
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => $idpBaseURL . (getenv('SIMPLESAMLPHP_IDP_SIGNON_HTTP_REDIRECT_BINDING') ?: $fallbackBinding),
    ],
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:SOAP',
      'Location' => $idpBaseURL . (getenv('SIMPLESAMLPHP_IDP_SIGNON_SOAP_BINDING') ?: $fallbackBinding),
    ],
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Artifact',
      'Location' => $idpBaseURL . (getenv('SIMPLESAMLPHP_IDP_SIGNON_HTTP_ARTIFACT') ?: $fallbackBinding),
    ],
  ],
  'SingleLogoutService' => [
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST',
      'Location' => $idpBaseURL . (getenv('SIMPLESAMLPHP_IDP_LOGOUT_HTTP_POST_BINDING') ?: $fallbackBinding),
    ],
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect',
      'Location' => $idpBaseURL . (getenv('SIMPLESAMLPHP_IDP_LOGOUT_HTTP_REDIRECT_BINDING') ?: $fallbackBinding),
    ],
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Artifact',
      'Location' => $idpBaseURL . (getenv('SIMPLESAMLPHP_IDP_LOGOUT_HTTP_ARTIFACT') ?: $fallbackBinding),
    ],
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:SOAP',
      'Location' => $idpBaseURL . (getenv('SIMPLESAMLPHP_IDP_LOGOUT_SOAP_BINDING') ?: $fallbackBinding),
    ],
  ],
  'ArtifactResolutionService' => [
    [
      'Binding' => 'urn:oasis:names:tc:SAML:2.0:bindings:SOAP',
      'Location' => $idpBaseURL . (getenv('SIMPLESAMLPHP_IDP_ARTIFACT_SOAP_BINDING') ?: $fallbackBinding),
      'index' => 0,
    ],
  ],
  'NameIDFormats' => [
    'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent',
    'urn:oasis:names:tc:SAML:2.0:nameid-format:transient',
    'urn:oasis:names:tc:SAML:1.1:nameid-format:unspecified',
    'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress',
  ],
  'keys' => [
    [
      'encryption' => getenv('SIMPLESAMLPHP_IDP_CERT_ENCRYPT') ?: FALSE,
      'signing' => getenv('SIMPLESAMLPHP_IDP_CERT_SIGNING') ?: TRUE,
      'type' => getenv('SIMPLESAMLPHP_IDP_CERT_TYPE') ?: 'X509Certificate',
      'X509Certificate' => getenv('SIMPLESAMLPHP_IDP_CERT'),
    ],
  ],
];
