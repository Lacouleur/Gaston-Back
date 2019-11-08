import React from 'react';
import { Container, Image, Menu } from 'semantic-ui-react';

const FooterNav = () => (
  <div>
    <Menu fixed="bottom" inverted>
      <Container>
        <Menu.Item as="a" header>
          <Image
            size="mini"
            src="/public/DumpsterLogoswhite.png"
            style={{ marginRight: '1.5em' }}
          />
          Powa
        </Menu.Item>
        <Menu.Item as="a">Un menu en Bas</Menu.Item>
      </Container>
    </Menu>
  </div>
);

export default FooterNav;
